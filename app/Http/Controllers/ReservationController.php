<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;

class ReservationController extends Controller
{
    //

    public function showBook($id)
    {
        $books = Book::find($id);
        $stocks = Stock::find($id);

        $suggest = DB::table('suggestions')
            ->where('suggestions.email', "=", Auth::user()->email)
            ->get();

            $category = $books->category;
            if($category === "LT")
            {
                $lifestyle_number = $suggest[0]->lifestyle_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['lifestyle_number' => $lifestyle_number + 1]);
            }elseif($category === "F")
            {
                $food_number = $suggest[0]->food_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['food_number' => $food_number + 1]);
            }elseif($category === "KID")
            {
                $kids_number = $suggest[0]->kids_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['kids_number' => $kids_number + 1]);
            }elseif($category === "LIT")
            {
                $literature_number = $suggest[0]->literature_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['literature_number' => $literature_number + 1]);
            }elseif($category === "COM")
            {
                $comics_number = $suggest[0]->comics_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['comics_number' => $comics_number + 1]);
            }elseif($category === "CLA")
            {
                $classics_number = $suggest[0]->classics_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['classics_number' => $classics_number + 1]);
            }elseif($category === "ART")
            {
                $art_number = $suggest[0]->art_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['art_number' => $art_number + 1]);
            }elseif($category === "FIN")
            {
                $financial_number = $suggest[0]->financial_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['financial_number' => $financial_number + 1]);
            }elseif($category === "S")
            {
                $sport_number = $suggest[0]->sport_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['sport_number' => $sport_number + 1]);
            }elseif($category === "L")
            {
                $learning_number = $suggest[0]->learning_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['learning_number' => $learning_number + 1]);
            }elseif($category === "TEC")
            {
                $tech_number = $suggest[0]->tech_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['tech_number' => $tech_number + 1]);
            }elseif($category === "H")
            {
                $history_number = $suggest[0]->history_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['history_number' => $history_number + 1]);
            }elseif($category === "TRA")
            {
                $travel_number = $suggest[0]->travel_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['travel_number' => $travel_number + 1]);
            }elseif($category === "REL")
            {
                $religion_number = $suggest[0]->religion_number;

                $suggToSave = DB::table('suggestions')
                    ->where('suggestions.email', Auth::user()->email)
                    ->update(['religion_number' => $religion_number + 1]);
            }

        return view('member.book', compact('books', 'stocks'));
    }

    function reserve($id)
    {
        $user = DB::table('users')
        ->where('users.email', "=", Auth::user()->email)
        ->get();

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

            session(['reservation' => 'Könyvet csak aktív előfizetéssel rendelkezők foglalhatnak!']);
            return redirect('/books-available');

        }else
        {
            $current = $user[0]->current;
            $max = $user[0]->max;
            $stock = Stock::find($id);
            $res = new Reservation;
            $res->date = Carbon::today();
            $res->expiry = Carbon::tomorrow();
            $res->email = Auth::user()->email;
            $res->isbn = $stock->isbn;
            if ($current < $max) {
                $res->save();
                $userToSave = DB::table('users')
                    ->where('users.email', Auth::user()->email)
                    ->update(['current' => $current + 1]);

                $stock->available_number = $stock->available_number - 1;
                $stock->save();

                $book = Book::find($id);

                $suggest = DB::table('suggestions')
                ->where('suggestions.email', "=", Auth::user()->email)
                ->get();

                $category = $book->category;
                if($category === "LT")
                {
                    $lifestyle_number = $suggest[0]->lifestyle_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['lifestyle_number' => $lifestyle_number + 1]);
                }elseif($category === "F")
                {
                    $food_number = $suggest[0]->food_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['food_number' => $food_number + 1]);
                }elseif($category === "KID")
                {
                    $kids_number = $suggest[0]->kids_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['kids_number' => $kids_number + 1]);
                }elseif($category === "LIT")
                {
                    $literature_number = $suggest[0]->literature_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['literature_number' => $literature_number + 1]);
                }elseif($category === "COM")
                {
                    $comics_number = $suggest[0]->comics_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['comics_number' => $comics_number + 1]);
                }elseif($category === "CLA")
                {
                    $classics_number = $suggest[0]->classics_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['classics_number' => $classics_number + 1]);
                }elseif($category === "ART")
                {
                    $art_number = $suggest[0]->art_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['art_number' => $art_number + 1]);
                }elseif($category === "FIN")
                {
                    $financial_number = $suggest[0]->financial_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['financial_number' => $financial_number + 1]);
                }elseif($category === "S")
                {
                    $sport_number = $suggest[0]->sport_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['sport_number' => $sport_number + 1]);
                }elseif($category === "L")
                {
                    $learning_number = $suggest[0]->learning_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['learning_number' => $learning_number + 1]);
                }elseif($category === "TEC")
                {
                    $tech_number = $suggest[0]->tech_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['tech_number' => $tech_number + 1]);
                }elseif($category === "H")
                {
                    $history_number = $suggest[0]->history_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['history_number' => $history_number + 1]);
                }elseif($category === "TRA")
                {
                    $travel_number = $suggest[0]->travel_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['travel_number' => $travel_number + 1]);
                }elseif($category === "REL")
                {
                    $religion_number = $suggest[0]->religion_number;

                    $suggToSave = DB::table('suggestions')
                        ->where('suggestions.email', Auth::user()->email)
                        ->update(['religion_number' => $religion_number + 1]);
                }

                session(['reservation' => 'Foglalás Sikeres!']);
                return redirect('/myreservations');
            }else {
                session(['reservation' => 'Egyszerre nem foglalhatsz, vagy kölcsönözhetsz több könyvet!']);
                return redirect('/books-available');
            }
        }

    }

    function showMyReservations()
    {
        $data = DB::table('reservations')
            ->join('stocks', 'reservations.isbn', "=", 'stocks.isbn')
            ->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->join('users', 'reservations.email', "=", 'users.email')
            ->where('reservations.email', '=', Auth::user()->email)
            ->select('title', 'writer', 'reservations.isbn', 'release', 'expiry', 'reservations.id', 'picture','edition',)
            ->orderBy('expiry', 'asc')
            ->get();
        return view('member/my_reservations', ['myreservations' => $data]);
    }

    function delete($id)
    {
        $res = Reservation::find($id);
        $user = DB::table('users')
            ->where('users.email', "=", Auth::user()->email)
            ->get();

        $current = $user[0]->current;
        $max = $user[0]->max;

        $seged = DB::table('stocks')
            ->join('reservations', 'stocks.isbn', "=", 'reservations.isbn')
            ->where('stocks.isbn', '=', $res->isbn)
            ->get();

        $number = $seged[0]->available_number;

        $stock = DB::table('stocks')
            ->where('stocks.isbn', $res->isbn)
            ->update(['available_number' => $number + 1]);

        $userToSave = DB::table('users')
            ->where('users.email', Auth::user()->email)
            ->update(['current' => $current - 1]);

        $res->delete();
        session(['deleteReservation' => 'Foglalás törölve!']);
        return redirect('/myreservations');
    }

    function showAllReservations()
    {
        $data = DB::table('reservations')
            ->join('books', 'reservations.isbn', "=", 'books.isbn')
            ->join('users', 'reservations.email', "=", 'users.email')
            ->select('title', 'name', 'reservations.email', 'reservations.isbn', 'expiry', 'reservations.id','picture','writer', 'release', 'edition',)
            ->orderBy('reservations.expiry', 'asc')
            ->get();
        return view('employee/reservations', ['reservations' => $data]);
    }

}
