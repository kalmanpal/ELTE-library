<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    function show()
    {
        $data= DB::table('users')
        ->orderBy('name', 'asc')
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
            // session(['updatedata' => 'Az adatok módosítása sikerült!']);
            return redirect('/home');
        }else{
        //     session(['updatedata' => 'Az adatok módosítása nem sikerült, ellenőrizze, hogy a megfelelő jelszót írta be!']);
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
        return redirect('users');
    }




}
