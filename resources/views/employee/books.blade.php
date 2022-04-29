@extends('layouts.app')
@section('content')

<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Könyvek

                    <form type="get" method="GET" action="{{ url('/emp-search-books-results') }}" >
                        @csrf
                        <input class="form-control form-control-sm"  type="search"  name="emp-book-query" placeholder="Itt kereshet..." required>
                        <button type="submit" class="btn btn-primary btn-sm">Keresés</button>
                    </form>

                </div>
                <div class="card-body">

                    {{-- <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Cím</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Író</th>
                            <th scope="col">Kiadás éve</th>
                            <th scope="col">Kiadás</th>
                            <th scope="col">Összes</th>
                            <th scope="col">Elérhető</th>
                          </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $item)
                                <tr id="{{ $item->id }}" href>
                                    <td>
                                        <img src="{{ asset('storage/app/'.$item->picture) }}" class="w-10">
                                    </td>
                                    <td>
                                    <a class="td_class" href="{{ url('edit-book/'.$item->id) }}">{{ $item->title }}</a>
                                    </td>
                                    <td>
                                        {{ $item->isbn }}
                                    </td>
                                    <td>
                                        {{ $item->writer }}
                                    </td>
                                    <td>
                                        {{ $item->release }}
                                    </td>
                                    <td>
                                        {{ $item->edition }}
                                    </td>
                                    <td>
                                        {{ $item->max_number }}
                                    </td>
                                    <td>
                                        {{ $item->available_number }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}


                        <div class="webshop-container">
                            @foreach ($books as $item)
                                <a class="no-underline" href="{{ url('edit-book/'.$item->id) }}">
                                    <div class="card" style="width: 15rem;">
                                        <img class="card-img-top book-image" src="{{ asset($item->picture) }}" alt="">
                                        <div class="card-body" style="height: 195px">
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
