<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BadgeController extends Controller
{
    public function numbersForBadges()
    {
        $dataToUpdate = DB::table('badges')
        ->where('badges.email', '=', Auth::user()->email)
        ->get();

        $allRentals = DB::table('rentals')
            ->where('rentals.email', '=', Auth::user()->email)
            ->get();
        $allRentsNumber = $allRentals->count();

        if(($allRentsNumber >= 5)&($dataToUpdate->five != 1)){
            $dataToUpdate->five = 1;
            $dataToUpdate->save();
        }

        if(($allRentsNumber >= 10)&($dataToUpdate->ten != 1)){
            $dataToUpdate->ten = 1;
            $dataToUpdate->save();
        }

        if(($allRentsNumber >= 20)&($dataToUpdate->twenty != 1)){
            $dataToUpdate->twenty = 1;
            $dataToUpdate->save();
        }

        $onTimeRentals = DB::table('rentals')
        ->where('rentals.email', '=', Auth::user()->email)
        ->whereNotNull('in_date')
        ->get();
        $n = $onTimeRentals->count();

        $onTimeNumber = 0;
        for($i = 0; $i < $n; $i+=1){
            if($onTimeRentals[$i]->in_date <= $onTimeRentals[$i]->deadline){
                $onTimeNumber++;
            }
        }

        if(($onTimeNumber >= 10)&($dataToUpdate->ontime != 1)){
            $dataToUpdate->ontime = 1;
            $dataToUpdate->save();
        }

        // $allSubs = DB::table('oldsubs')
        // ->where('oldsubs.email', '=', Auth::user()->email)
        // ->get();
        $allSubsNumber = 0; //$allSubs->count();

        // if(($allSubsNumber >= 2)&($dataToUpdate->oneyear != 1)){
        //     $dataToUpdate->oneyear = 1;
        //     $dataToUpdate->save();
        // }

        $data = collect([$allRentsNumber, $onTimeNumber, $allSubsNumber]);

        return view('member/badges', ['data' => $data]);
    }




}
