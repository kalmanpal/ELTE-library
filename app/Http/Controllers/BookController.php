<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\Book;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //

    // function addBook(Request $req)
    // {
    //     return $req->file('picture')->store('pictures');
    // }


    function addBook(Request $req)
    {

        $books = Book::where('isbn', $req->isbn)->get();
        if(sizeof($books) > 0){
            $msg = 'Ezzel az isbn-el van már könyv felvéve!';
            session(['newBookFailed' => 'Ezzel az ISBN számmal már létezik egy könyv a rendszerben!']);
            return redirect('/newbook');
        }

        $book = new Book;
        $book->isbn = $req->isbn;
        $book->title = $req->title;
        $book->writer = $req->writer;
        $book->publisher = $req->publisher;
        $book->release = $req->release;
        $book->edition = $req->edition;
        $book->category = $req->category;
        $book->description = $req->description;
        $book->picture = $req->file('picture')->store('pictures');
        $book->save();

        $stock = new Stock;
        $stock->isbn = $req->isbn;
        $stock->max_number = $req->max_number;
        $stock->available_number = $req->max_number;
        $stock->save();

        session(['newBook' => 'A könyv bekerült a rendszerbe!']);
        return redirect('/books');
    }


    function showBooks()
    {
        $data = DB::table('books')->join('stocks', 'books.isbn', "=", 'stocks.isbn')
        ->orderBy('title', 'asc')
        ->get();
        return view('employee/books', ['books' => $data]);
    }


    public function edit($id)
    {
        $books = Book::find($id);
        $stocks = Stock::find($id);
        return view('employee.edit_book', compact('books', 'stocks'));
    }

    public function update(Request $req, $id)
    {
        $books = Book::find($id);
        $stocks = Stock::find($id);

        $books->title = $req->title;
        $books->writer = $req->writer;
        $books->publisher = $req->publisher;
        $books->release = $req->release;
        $books->edition = $req->edition;
        $books->description = $req->description;
        // $books->picture = $req->file('picture')->store('pictures');
        $books->update();
        $stocks->max_number = $req->max_number;
        $stocks->available_number = $req->max_number;
        $stocks->update();
        session(['bookUpdate' => 'Az könyv adatok módosítása sikerült!']);
        return redirect('books');
    }


    public function showAvailableBooks()
    {
        $data = DB::table('stocks')->join('books', 'stocks.isbn', "=", 'books.isbn')
        ->where('stocks.available_number', '>', 0)
        ->orderBy('title', 'asc')
        ->get();
        return view('member/books', ['books' => $data]);
    }


}
