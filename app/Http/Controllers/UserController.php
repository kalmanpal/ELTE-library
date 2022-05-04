<?php

namespace App\Http\Controllers;

use App\Mail\PwEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;
use App\Models\Suggestion;
use App\Models\Badge;
use App\Models\Oldsub;
use Carbon\Carbon;

class UserController extends Controller
{
    //

    function showUsers()
    {
        $data= DB::table('users')
        ->orderBy('name', 'asc')
        ->where('type', '=', 'ES')
        ->orwhere('type', '=', 'ET')
        ->orwhere('type', '=', 'O')
        ->get();
        return view('employee/users',['users'=>$data]);
    }

    public function update(Request $req)
    {
        $user = User::where('email', request('email'))->first();
        if (Hash::check(request('password'), $user->password)){
            $user-> email=$req->email;
            $user-> name=$req->name;
            $user-> city=$req->city;
            $user-> address=$req->address;
            if(!empty($req->newPw))
            {
                $user->password=bcrypt($req->newPw);
            }
            $user-> save();
            session(['profileUpdate' => 'Az adatok módosítása sikerült!']);
            return redirect('/profile');
        }else{
             session(['profileUpdate' => 'Az adatok módosítása nem sikerült, ellenőrizze, hogy a megfelelő jelszót írta be!']);
             return redirect('/profile');
        }
    }

    public function index($id)
    {
        $member = User::find($id);
        $subs = DB::table('oldsubs')
        ->where('oldsubs.email', '=', $member->email)
        ->orderBy('to', 'asc')
        ->get();

        $isActive = DB::table('subscriptions')
        ->where('subscriptions.email', '=', $member->email)
        ->get();

        if($subs->isEmpty())
        {
            return view('employee.this_member', compact('member', 'subs', 'isActive'));
        }else
        {
            if(($subs->last()->to < Carbon::today()) && ($isActive[0]->active != 0))
            {
                $subToUpdate = DB::table('subscriptions')
                ->where('subscriptions.email', $member->email)
                ->update([
                    'active'  => '0'
                ]);

                $isActive = DB::table('subscriptions')
                ->where('subscriptions.email', '=', $member->email)
                ->get();
            }
            return view('employee.this_member', compact('member', 'subs', 'isActive'));
        }
    }


    public function updateAsEmp(Request $req, $id)
    {
        $member = User::find($id);
        $member->name=$req->name;
        $member->city=$req->city;
        $member->address=$req->address;
        $member->type=$req->type;
        $member-> update();
        session(['profileUpdateAsEmployee' => 'A felhasználó adatai módosultak!']);
        return redirect('users');
    }

    public function addUser(Request $req)
    {

        $userToCheck = DB::table('users')
            ->where('users.email', "=", $req->email)
            ->get();

        if($userToCheck->isEmpty())
        {

            $user = new User;
            $user-> email=$req->email;
            $user-> name=$req->name;
            $user-> city=$req->city;
            $user-> address=$req->address;
            $user-> type=$req->type;

            if($req->type === "ES")
            {
                $user->max = 10;

            }elseif($req->type === "ET")
            {
                $user->max = 20;

            }elseif($req->type === "O")
            {
                $user->max = 5;
            }

            $user-> password=bcrypt($req->password);

            $data = [
                'name' => $req->name,
                'email' => $req->email,
                'password' => $req->password,
            ];

            Mail::to('eltekonyvtar2022@gmail.com')->send(new PwEmail($data));

            $user-> save();

            $suggestion = new Suggestion;
            $suggestion->email = $req->email;
            $suggestion->save();

            $badges = new Badge;
            $badges->email = $req->email;
            $badges->save();

            $subs = new Subscription;
            $subs->email = $req->email;
            $subs->save();

            session(['newUser' => 'Az új felhasználó sikeresen regisztrálva!']);
            return redirect('/users');

        }else
        {
            session(['newUser' => 'A regisztráció sikertelen, ezzel az email címmel már van regisztrált felhasználó!']);
            return redirect('/new-user');
        }

    }

    public function activateSub($id)
    {
        $userToActivate = User::find($id);

        $subToSave = new Oldsub();
        $subToSave->email = $userToActivate->email;
        $subToSave->from = Carbon::today();
        $subToSave->to = Carbon::today()->addMonth(6);
        $subToSave->save();

        $sub = DB::table('subscriptions')
        ->where('subscriptions.email', '=', $userToActivate->email)
        ->get();

        $subToUpdate = DB::table('subscriptions')
            ->where('subscriptions.email', $userToActivate->email)
            ->update([
                'all_months' => $sub[0]->all_months + 6,
                'active'  => '1',
                'subexpiry' => Carbon::today()->addMonth(6),
                'discounts' => 0,
                'plus_charge' => 0
            ]);

        session(['subActivated' => 'Az előfizetés aktiválva!']);
        return redirect('/users');
    }

    public function searchUsers()
    {
        $search_text = $_GET['emp-users-query'];
        $usersSearched= DB::table('users')
        ->where('name', 'LIKE', '%'.$search_text.'%')
        ->where('type', '!=', 'E')
        ->orderBy('name', 'asc')
        ->get();

        return view('employee.user_results', compact('usersSearched'));
    }

}
