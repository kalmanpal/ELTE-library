@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Elérhető könyvek
                    <form type="get" method="GET" action="{{ url('/mem-search-books-results') }}" >
                        @csrf
                        <input class="form-control form-control-sm"  type="search"  name="mem-book-query" placeholder="Itt kereshet..." required>
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
                          </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $item)
                                <tr id="{{ $item->id }}" href>
                                    <td>
                                        <img src="{{ asset('storage/app/pictures/'.$item->picture) }}" class="w-10">
                                        </td>
                                    <td>
                                    <a class="td_class" href="{{ url('book/'.$item->id) }}">{{ $item->title }}</a>
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
                                </tr>
                            @endforeach
                        </tbody> --}}


                    <div class="webshop-container">
                        @foreach ($books as $item)
                            <a class="no-underline" href="{{ url('book/'.$item->id) }}">
                                <div class="card" style="width: 15rem;">
                                    <img class="book-image" src="https://s04.static.libri.hu/cover/f0/3/1243841_5.jpg" class="card-img-top" alt="...">
                                    <div class="card-body" style="height: 150px">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text card-remove-gap">{{ $item->isbn }}</p>
                                        <p class="card-text card-remove-gap">{{ $item->writer }}</p>
                                        <p class="card-text card-remove-gap">{{ $item->release }}</p>
                                    </div>
                              </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            {{$books->links()}}
        </div>
    </div>
</div>
<?php
    if(session()->has('reservation')){
        echo "<script>alert('".session('reservation')."');</script>";
        session()->forget('reservation');
    }
?>

@endsection
