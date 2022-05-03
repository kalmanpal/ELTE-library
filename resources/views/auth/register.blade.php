@extends('layouts.app')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<head>
    <title>Fiók létrehozása</title>
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Fiók létrehozása') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Név') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" minlength="3" maxlength="35"  autofocus id="onlyLettersName">

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  maxlength="40">

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
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus minlength="2" maxlength="30" id="onlyLettersCity">

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
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="" autofocus minlength="3" maxlength="40">

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
                                    <option value="E">Emp</option>
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" maxlength="30">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Jelszó újra') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="cb-register mb-2">
                            <input class="cb-size" type="checkbox" required>
                            <label class="cb-text">Elismerem, hogy a megadott adatok megfelelnek a valóságnak.</label><br>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{-- <input value="submit" type="submit" class="btn btn-primary">
                                    {{ __('Regisztráció') }}
                                </input> --}}

                                <input type="submit" value="Regisztáció" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
</script>

@endsection
