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
        return view('member.book', compact('books', 'stocks'));
    }

    function reserve($id)
    {
        $user = DB::table('users')
            ->where('users.email', "=", Auth::user()->email)
            ->get();
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
            session(['reservation' => 'Foglalás Sikeres!']);
            return redirect('/myreservations');
        }else {
            session(['reservation' => 'Egyszerre nem foglalhatsz, vagy kölcsönözhetsz több könyvet!']);
            return redirect('/books-available');
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
