@extends('layouts.app')

<head>
    <title>Kezdőlap</title>
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vezérlőpult</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Sikeres bejelentkezés!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
