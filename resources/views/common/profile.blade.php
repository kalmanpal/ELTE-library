@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<head>
    <title>Profil</title>
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Saját profil</div>

                <div class="card-body">
                    <form method="POST" action="/update-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Név</label>
                            <div class="col-md-6">
                                <input class="form-control" name="name" value="{{ Auth::user()->name }}" required id="onlyLettersName" minlength="3" maxlength="35">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">Település</label>
                            <div class="col-md-6">
                                <input class="form-control " name="city" value="{{ Auth::user()->city }}" required id="onlyLettersCity" minlength="2" maxlength="30">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Cím</label>
                            <div class="col-md-6">
                                <input class="form-control" name="address" value="{{ Auth::user()->address }}" required minlength="3" maxlength="40">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Új jelszó</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" id="new-pw" name="newPw" minlength="6" maxlength="30">
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <img class="toggle-pw"src="https://cdn2.iconfinder.com/data/icons/lightly-icons/30/visibility-off-240.png" alt="" height=" 30px" onclick="togglePw()">
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Jelszó</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required maxlength="30">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Adatok módosítása" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(session()->has('profileUpdate')){
        echo "<script>alert('".session('profileUpdate')."');</script>";
        session()->forget('profileUpdate');
    }
?>

<script>
    $(function() {
        $('#onlyLettersName').keydown(function (e) {
            if ( e.ctrlKey || e.altKey) {
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if (((key >=48) && (key <=57)) ||  (key == 190) || ((key >=96) && (key <=111))) {
                    e.preventDefault();
                }
            }
        });
    });

    $(function() {
        $('#onlyLettersCity').keydown(function (f) {
            if (f.ctrlKey || f.altKey) {
                f.preventDefault();
            } else {
                var key = f.keyCode;
                if (((key >=48) && (key <=57)) ||  (key == 190) || ((key >=96) && (key <=111))) {
                    f.preventDefault();
                }
            }
        });
    });


    function togglePw() {
        var x = document.getElementById("new-pw");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

@endsection
