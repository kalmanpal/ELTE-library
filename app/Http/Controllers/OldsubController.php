<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oldsub;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OldsubController extends Controller
{

    function showMySubs()
    {
        $oldSubs = DB::table('oldsubs')
        ->where('oldsubs.email', '=', Auth::user()->email)
        ->orderBy('to', 'asc')
        ->get();

        $allSubs = DB::table('subscriptions')
        ->where('subscriptions.email', '=', Auth::user()->email)
        ->get();


        if($oldSubs->isEmpty())
        {
            return view('member.subscriptions', compact('oldSubs', 'allSubs'));
        }else
        {
            if(($oldSubs->last()->to < Carbon::today()) && ($allSubs[0]->active != 0))
            {
                $subToUpdate = DB::table('subscriptions')
                ->where('subscriptions.email', Auth::user()->email)
                ->update([
                    'active'  => '0'
                ]);

                $allSubs = DB::table('subscriptions')
                ->where('subscriptions.email', '=', Auth::user()->email)
                ->get();
            }

            return view('member.subscriptions', compact('oldSubs', 'allSubs'));
        }

    }

}
