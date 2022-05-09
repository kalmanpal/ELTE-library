<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\User;
use App\Models\Book;

class RentalController extends Controller
{
    function showActiveRentals()
    {
        $data = DB::table('rentals')
            ->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')
            ->join('users', 'rentals.email', "=", 'users.email')
            ->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->select('users.name', 'rentals.email', 'rentals.out_date', 'rentals.isbn', 'rentals.deadline', 'rentals.id', 'title',)
            ->whereNull('in_date')
            ->orderBy('users.name', 'asc')
            ->get();
        return view('employee/active_rentals', ['rentals' => $data]);
    }

    function showClosedRentals()
    {
        $data = DB::table('rentals')
            ->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')
            ->join('users', 'rentals.email', "=", 'users.email')
            ->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->select('users.name', 'rentals.email', 'rentals.out_date', 'rentals.isbn', 'rentals.deadline', 'rentals.id', 'title', 'in_date')
            ->whereNotNull('in_date')
            ->orderBy('users.name', 'asc')
            ->get();
        return view('employee/closed_rentals', ['rentals' => $data]);
    }

    function showMyRentals()
    {
        $data = DB::table('rentals')
            ->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')
            ->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->where('email', '=', Auth::user()->email)
            ->orderBy('in_date', 'desc')
            ->select('rentals.out_date', 'rentals.isbn', 'rentals.deadline', 'rentals.id', 'title', 'in_date', 'rentals.rating')
            ->get();
        return view('member/my_rentals', ['rentals' => $data]);
    }

    function rentFromReservations($id)
    {

        $res = Reservation::find($id);
        $rent = new Rental();
        $rent->out_date = Carbon::today();

        $seged = DB::table('reservations')
            ->join('users', 'reservations.email', "=", 'users.email')
            ->get();

        $type = $seged[0]->type;

        if ($type == "ES") {
            $rent->deadline = Carbon::today()->addMonth(3);
        } elseif($type == "ET")
        {
            $rent->deadline = Carbon::today()->addMonth(6);
        } elseif($type == "O")
        {
            $rent->deadline = Carbon::today()->addMonth(1);
        }

        $rent->isbn = $res->isbn;
        $rent->email = $res->email;
        $rent->save();
        $res->delete();

        //session(['rentfromres' => 'A könyv kikölcsönözve!']);

        return redirect('/active-rentals');
    }

    function bookIsBack($id)
    {

        $rent = Rental::find($id);
        $rent->in_date = Carbon::today();
        $email = $rent->email;
        $rent->save();

        $user = DB::table('users')
            ->where('users.email', "=", $email)
            ->get();

        $current = $user[0]->current;
        $max = $user[0]->max;

        $userToSave = DB::table('users')
            ->where('users.email', $email)
            ->update(['current' => $current - 1]);

        $seged = DB::table('stocks')
            ->join('rentals', 'stocks.isbn', "=", 'rentals.isbn')
            ->where('rentals.isbn', '=', $rent->isbn)
            ->get();

        $number = $seged[0]->available_number;

        $stock = DB::table('stocks')
            ->where('stocks.isbn', $rent->isbn)
            ->update(['available_number' => $number + 1]);

        //session(['bookback' => 'A könyv visszahozva!']);

        return redirect('/closed-rentals');
    }


    function rentBook(Request $requested, $id)
    {
        $user = DB::table('users')
            ->where('users.email', "=", $requested->mail)
            ->get();

        if($user->isNotEmpty()){

            $subs = DB::table('oldsubs')
            ->where('oldsubs.email', '=', $user[0]->email)
            ->get();

            if($subs->last()->to < Carbon::today())
            {
                $subToUpdate = DB::table('subscriptions')
                ->where('subscriptions.email', $user[0]->email)
                ->update([
                    'active'  => '0',
                    'subexpiry' => null
                ]);

                session(['rent' => 'Könyvet csak aktív előfizetéssel rendelkezők kölcsönözhetnek!']);
                return redirect('/books');

            }else{

                $email = $user[0]->email;

                $book = Book::find($id);
                $stock = Stock::find($id);

                $rental = New Rental();
                $rental->out_date = Carbon::today();
                $rental->isbn = $stock->isbn;
                $rental->email = $email;

                $type = $user[0]->type;
                $current = $user[0]->current;
                $max = $user[0]->max;

                if ($type == "ES") {
                    $rental->deadline = Carbon::today()->addMonth(3);
                } elseif($type == "ET")
                {
                    $rental->deadline = Carbon::today()->addMonth(6);
                } elseif($type == "O")
                {
                    $rental->deadline = Carbon::today()->addMonth(1);
                }

                if (($current < $max) && ($stock->available_number > 0)) {

                    $rental->save();
                    $userToSave = DB::table('users')
                        ->where('users.email', $email)
                        ->update(['current' => $current + 1]);

                    $stock->available_number = $stock->available_number - 1;
                    $stock->save();

                    $suggest = DB::table('suggestions')
                ->where('suggestions.email', "=", Auth::user()->email)
                ->get();

                $category = $book->category;
                if($category === "LT")
                {
                    $lifestyle_number = $suggest[0]->lifestyle_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['lifestyle_number' => $lifestyle_number + 1]);
                }elseif($category === "F")
                {
                    $food_number = $suggest[0]->food_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['food_number' => $food_number + 1]);
                }elseif($category === "KID")
                {
                    $kids_number = $suggest[0]->kids_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['kids_number' => $kids_number + 1]);
                }elseif($category === "LIT")
                {
                    $literature_number = $suggest[0]->literature_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['literature_number' => $literature_number + 1]);
                }elseif($category === "COM")
                {
                    $comics_number = $suggest[0]->comics_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['comics_number' => $comics_number + 1]);
                }elseif($category === "CLA")
                {
                    $classics_number = $suggest[0]->classics_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['classics_number' => $classics_number + 1]);
                }elseif($category === "ART")
                {
                    $art_number = $suggest[0]->art_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['art_number' => $art_number + 1]);
                }elseif($category === "FIN")
                {
                    $financial_number = $suggest[0]->financial_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['financial_number' => $financial_number + 1]);
                }elseif($category === "S")
                {
                    $sport_number = $suggest[0]->sports_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['sports_number' => $sport_number + 1]);
                }elseif($category === "L")
                {
                    $learning_number = $suggest[0]->learning_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['learning_number' => $learning_number + 1]);
                }elseif($category === "TEC")
                {
                    $tech_number = $suggest[0]->tech_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['tech_number' => $tech_number + 1]);
                }elseif($category === "H")
                {
                    $history_number = $suggest[0]->history_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['history_number' => $history_number + 1]);
                }elseif($category === "TRA")
                {
                    $travel_number = $suggest[0]->travel_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['travel_number' => $travel_number + 1]);
                }elseif($category === "REL")
                {
                    $religion_number = $suggest[0]->religion_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', $email)
                        ->update(['religion_number' => $religion_number + 1]);
                }
                    session(['rent' => 'A könyv sikeresen kikölcsönözve!']);
                    return redirect('/active-rentals');
                }else{
                    session(['rent' => 'A kölcsönzés sikertelen, a felhasználó már elérte a neki kiszabott kölcsönzési limitet, vagy jelenleg nincs készleten ez a könyv!']);
                    return redirect('/books');
                }
            }
        }else{
            session(['rent' => 'A kölcsönzés sikertelen, nincs a megadott email címmel regisztrált felhasználó!']);
            return redirect('/books');
        }

    }




}
