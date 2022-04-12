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

    public function activateSubByMember()
    {
        $newsub = new Oldsub;
        $newsub->email =  Auth::user()->email;
        $newsub->from = Carbon::today();
        $newsub->to = Carbon::today()->addMonth(6);
        $newsub->save();

        $sub = DB::table('subscriptions')
            ->where('subscriptions.email', '=', Auth::user()->email)
            ->get();

        $sub->all_months = $sub->all_months + 6;
        $sub->active = 1;
        $sub->subexpiry = Carbon::today()->addMonth(6);
        $sub->streak = 1;
        $sub->save();
    }

    public function activateSubByEmp($id)
    {
        $member = User::find($id);

        $newsub = new Oldsub;
        $newsub->email =  $member->email;
        $newsub->from = Carbon::today();
        $newsub->to = Carbon::today()->addMonth(6);
        $newsub->save();

        $sub = DB::table('subscriptions')
            ->where('subscriptions.email', '=', $member->email)
            ->get();

        $sub->all_months = $sub->all_months + 6;
        $sub->active = 1;
        $sub->subexpiry = Carbon::today()->addMonth(6);
        $sub->streak = 1;
        $sub->save();
    }

    function showMySubs()
    {
        $data = DB::table('oldsubs')
            ->where('oldsubs.email', '=', Auth::user()->email)
            ->select('from', 'to')
            ->orderBy('to', 'desc')
            ->get();
        return view('member/subscriptions', ['mysubs' => $data]);
    }

    function showMemberSubs($id)
    {
        $member = User::find($id);

        $data = DB::table('oldsubs')
            ->where('oldsubs.email', '=', $member->email)
            ->select('from', 'to')
            ->orderBy('to', 'desc')
            ->get();
        return view('employee/subscriptions', ['subs' => $data]);
    }
}
