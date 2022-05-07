@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <form type="get" method="GET" action="{{ url('/emp-search-users-results') }}" >
                        @csrf
                        <div class="searchbar-container">
                            <div>
                                Felhasználók
                            </div>
                            <div>
                                <input class="text-input-area"  type="search"  name="emp-users-query" placeholder="Itt kereshet..." required>
                                <button type="submit" class="search-button">Keresés</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    <table class="table">
                        <tbody>
                            @foreach ($users as $item)
                                <tr id="{{ $item->id }}">
                                    <td>
                                    <a class="td_class" href="{{ url('member/'.$item->id) }}">{{ $item->name }}</a>
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->city }}
                                    </td>
                                    <td>
                                        {{ $item->address }}
                                    </td>
                                    <td>
                                        {{ $item->type }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(session()->has('profileUpdateAsEmployee')){
        echo "<script>alert('".session('profileUpdateAsEmployee')."');</script>";
        session()->forget('profileUpdateAsEmployee');
    }

    if(session()->has('newUser')){
        echo "<script>alert('".session('newUser')."');</script>";
        session()->forget('newUser');
    }

    if(session()->has('subActivated')){
        echo "<script>alert('".session('subActivated')."');</script>";
        session()->forget('subActivated');
    }
?>

@endsection
