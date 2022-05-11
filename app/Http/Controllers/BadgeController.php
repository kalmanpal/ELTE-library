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

        if(($allRentsNumber >= 5)&($dataToUpdate[0]->five != 1)){
            $badgeToUpdate = DB::table('badges')
            ->where('badges.email', Auth::user()->email)
            ->update([
                'five' => '1'
            ]);

            $sub = DB::table('subscriptions')
            ->where('subscriptions.email', '=', Auth::user()->email)
            ->get();

            $subToUpdate = DB::table('subscriptions')
            ->where('subscriptions.email', Auth::user()->email)
            ->update([
                'discounts' => $sub[0]->discounts + 5
            ]);
        }

        if(($allRentsNumber >= 10)&($dataToUpdate[0]->ten != 1)){
            $badgeToUpdate = DB::table('badges')
            ->where('badges.email', Auth::user()->email)
            ->update([
                'ten' => '1'
            ]);

            $sub = DB::table('subscriptions')
            ->where('subscriptions.email', '=', Auth::user()->email)
            ->get();

            $subToUpdate = DB::table('subscriptions')
            ->where('subscriptions.email', Auth::user()->email)
            ->update([
                'discounts' => $sub[0]->discounts + 10
            ]);
        }

        if(($allRentsNumber >= 20)&($dataToUpdate[0]->twenty != 1)){
            $badgeToUpdate = DB::table('badges')
            ->where('badges.email', Auth::user()->email)
            ->update([
                'twenty' => '1'
            ]);

            $sub = DB::table('subscriptions')
            ->where('subscriptions.email', '=', Auth::user()->email)
            ->get();

            $subToUpdate = DB::table('subscriptions')
            ->where('subscriptions.email', Auth::user()->email)
            ->update([
                'discounts' => $sub[0]->discounts + 20
            ]);
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

        if(($onTimeNumber >= 10)&($dataToUpdate[0]->ontime != 1)){
            $badgeToUpdate = DB::table('badges')
            ->where('badges.email', Auth::user()->email)
            ->update([
                'ontime' => '1'
            ]);

            $sub = DB::table('subscriptions')
            ->where('subscriptions.email', '=', Auth::user()->email)
            ->get();

            $subToUpdate = DB::table('subscriptions')
            ->where('subscriptions.email', Auth::user()->email)
            ->update([
                'discounts' => $sub[0]->discounts + 5
            ]);
        }

        $allSubs = DB::table('oldsubs')
        ->where('oldsubs.email', '=', Auth::user()->email)
        ->get();
        $allSubsNumber = $allSubs->count();

        if(($allSubsNumber >= 2)&($dataToUpdate[0]->oneyear != 1)){
            $badgeToUpdate = DB::table('badges')
            ->where('badges.email', Auth::user()->email)
            ->update([
                'oneyear' => '1'
            ]);

            $sub = DB::table('subscriptions')
            ->where('subscriptions.email', '=', Auth::user()->email)
            ->get();

            $subToUpdate = DB::table('subscriptions')
            ->where('subscriptions.email', Auth::user()->email)
            ->update([
                'discounts' => $sub[0]->discounts + 10
            ]);
        }

        $data = collect([$allRentsNumber, $onTimeNumber, $allSubsNumber]);

        return view('member/badges', ['data' => $data]);
    }
}
