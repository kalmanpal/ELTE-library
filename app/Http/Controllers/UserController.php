<?php

namespace App\Http\Controllers;

use App\Mail\PwEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        return view('employee.this_member', compact('member'));
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

            session(['newUser' => 'Az új felhasználó sikeresen regisztrálva!']);
            return redirect('/users');

        }else
        {
            session(['newUser' => 'A regisztráció sikertelen, ezzel az email címmel már van regisztrált felhasználó!']);
            return redirect('/new-user');
        }

    }

}
