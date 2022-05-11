@extends('layouts.app')

<head>
    <title>Könyvek</title>
</head>

@section('content')

<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <form type="get" method="GET" action="{{ url('/emp-search-books-results') }}" >
                        @csrf
                        <div class="searchbar-container">
                            <div>
                                Könyvek
                            </div>
                            <div>
                                <input class="text-input-area"  type="search"  name="emp-book-query" placeholder="Itt kereshet..." required>
                                <button type="submit" class="search-button">Keresés</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="webshop-container">
                        @foreach ($books as $item)
                            <a class="no-underline" href="{{ url('edit-book/'.$item->id) }}">
                                <div class="card" style="width: 15rem;">
                                    <img class="card-img-top book-image" src="{{ asset('/storage/pictures/'.$item->picture) }}" alt="">
                                    <div class="card-body" style="height: 240px">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text card-remove-gap">{{ $item->isbn }}</p>
                                        <p class="card-text card-remove-gap">{{ $item->writer }}</p>
                                        <p class="card-text card-remove-gap">{{ $item->release }}</p>
                                        <p class="card-text card-remove-gap">Összes: {{ $item->max_number }}</p>
                                        <p class="card-text card-remove-gap">Elérhető: {{ $item->available_number }}</p>
                                    </div>
                              </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="paginate-container">
    {{$books->links()}}
</div>

<?php
    if(session()->has('newBook')){
        echo "<script>alert('".session('newBook')."');</script>";
        session()->forget('newBook');
    }

    if(session()->has('bookUpdate')){
        echo "<script>alert('".session('bookUpdate')."');</script>";
        session()->forget('bookUpdate');
    }
    if(session()->has('rent')){
        echo "<script>alert('".session('rent')."');</script>";
        session()->forget('rent');
    }
?>

@endsection
