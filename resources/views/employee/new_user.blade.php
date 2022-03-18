@extends('layouts.app')

<head>
    <title>Fiók létrehozása</title>
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Új felhasználó</div>

                <div class="card-body">
                    <form method="GET" action="/add-user">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Név') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- --- --}}






                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Település') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Cím') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Tagság típusa') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus> --}}

                                <select class="form-select" name="type" required>
                                    <option selected style="color: lightgrey">Válassz...</option>
                                    <option value="ES">ELTE hallgató</option>
                                    <option value="ET">ELTE oktató</option>
                                    <option value="O">Egyéb</option>
                                    <option value="E">Dolgozó</option>
                                </select>

                                {{-- @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>

                        {{-- --- --}}

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Jelszó') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="passwordrandom" required readonly autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{-- <input value="submit" type="submit" class="btn btn-primary">
                                    {{ __('Regisztráció') }}
                                </input> --}}

                                <input type="submit" value="Felhasználó hozzáadása" class="btn btn-primary">
                            </div>
                        </div>
                    </form>

                    <script>
                        // dec2hex :: Integer -> String
                        // i.e. 0-255 -> '00'-'ff'
                        function dec2hex (dec) {
                        return dec.toString(16).padStart(2, "0")
                        }
                        // generateId :: Integer -> String
                        function generateId (len) {
                        var arr = new Uint8Array((len || 40) / 2)
                        window.crypto.getRandomValues(arr)
                        return Array.from(arr, dec2hex).join('')
                        }
                        document.getElementById("passwordrandom").value = generateId(8);
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(session()->has('newUser')){
        echo "<script>alert('".session('newUser')."');</script>";
        session()->forget('newUser');
    }
?>
@endsection
