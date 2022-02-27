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
    function showRentals()
    {
        $data = DB::table('rentals')
            ->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')
            ->join('users', 'rentals.email', "=", 'users.email')
            ->select('name', 'out_date', 'rentals.isbn', 'deadline', 'rentals.id', 'in_date')
            ->orderBy('rentals.in_date', 'asc')
            ->get();
        return view('employee/active_rentals', ['rentals' => $data]);
    }

    function showMyRentals()
    {
        $data = DB::table('rentals')
            ->join('stocks', 'rentals.isbn', "=", 'stocks.isbn')
            ->join('books', 'stocks.isbn', "=", 'books.isbn')
            ->where('email', '=', Auth::user()->email)
            ->orderBy('in_date', 'asc')
            ->get();
        return view('member/my_rentals', ['rentals' => $data]);
    }






}
