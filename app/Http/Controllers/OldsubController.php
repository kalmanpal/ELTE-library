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
            ->select('from', 'to')
            ->get();

        $allSubs = DB::table('subscriptions')
        ->where('subscriptions.email', '=', Auth::user()->email)
        ->get();

        return view('member.subscriptions', compact('oldSubs', 'allSubs'));
    }

}
