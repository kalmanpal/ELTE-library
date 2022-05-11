<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class SuggestionController extends Controller
{
    function makeSuggestions()
    {
        $data = Suggestion::where('email', Auth::user()->email)->get();

        $art = $data[0]->art_number;
        $classics = $data[0]->classics_number;
        $comics = $data[0]->comics_number;
        $food = $data[0]->food_number;
        $history = $data[0]->history_number;
        $financial = $data[0]->financial_number;
        $kids = $data[0]->kids_number;
        $lifestyle = $data[0]->lifestyle_number;
        $learning = $data[0]->learning_number;
        $literature = $data[0]->literature_number;
        $travel = $data[0]->travel_number;
        $tech = $data[0]->tech_number;
        $religion = $data[0]->religion_number;
        $sports = $data[0]->sports_number;

        $array = [ $art, $classics, $comics, $food, $history, $financial, $kids, $lifestyle, $learning, $literature, $travel, $tech, $religion, $sports ];
        $max = max($array);
        $x = array_search($max, $array);

        if($x === 0)
        {
            $seged = "ART";
        }elseif($x === 1)
        {
            $seged = "CLA";
        }elseif($x === 2)
        {
            $seged = "COM";
        }elseif($x === 3)
        {
            $seged = "F";
        }elseif($x === 4)
        {
            $seged = "H";
        }elseif($x === 5)
        {
            $seged = "FIN";
        }elseif($x === 6)
        {
            $seged = "KID";
        }elseif($x === 7)
        {
            $seged = "LT";
        }elseif($x === 8)
        {
            $seged = "L";
        }elseif($x === 9)
        {
            $seged = "LIT";
        }elseif($x === 10)
        {
            $seged = "TRA";
        }elseif($x === 11)
        {
            $seged = "TEC";
        }elseif($x === 12)
        {
            $seged = "REL";
        }elseif($x === 13)
        {
            $seged = "S";
        }

        $booksToSuggest = DB::table('stocks')->join('books', 'stocks.isbn', "=", 'books.isbn')
        ->where('stocks.available_number', '>', 0)
        ->where('books.category', $seged)
        ->orderBy('title', 'asc')
        ->paginate(4);

        return view('member/suggestions', ['books' => $booksToSuggest]);
    }
}
