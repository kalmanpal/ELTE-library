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



}
