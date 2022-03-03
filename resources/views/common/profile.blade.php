@extends('layouts.app')

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
                                <input class="form-control" name="name" value="{{ Auth::user()->name }}" required>
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
                                <input class="form-control " name="city" value="{{ Auth::user()->city }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Cím</label>
                            <div class="col-md-6">
                                <input class="form-control" name="address" value="{{ Auth::user()->address }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Jelszó</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required>
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
@endsection
