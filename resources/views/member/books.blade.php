@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <form type="get" method="GET" action="{{ url('/mem-search-books-results') }}" >
                        @csrf
                        <div class="searchbar-container">
                            <div>
                                Elérhető könyvek
                            </div>
                            <div>
                                <input class="text-input-area"  type="search"  name="mem-book-query" placeholder="Itt kereshet..." required>
                                <button type="submit" class="search-button">Keresés</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="webshop-container">
                        @foreach ($books as $item)
                            <a class="no-underline" href="{{ url('book/'.$item->id) }}">
                                <div class="card" style="width: 15rem;">
                                    <img class="book-image" src="{{ asset('/storage/pictures/'.$item->picture) }}" class="card-img-top" alt="...">
                                    <div class="card-body" style="height: 170px">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <h6 class="card-text card-remove-gap">{{ $item->writer }}</h6>
                                        <p class="card-text card-remove-gap">{{ $item->release }}</p>
                                        <p class="card-text card-remove-gap">{{ $item->edition }} kiadás</p>
                                        @if ($item->numberofratings === 0)
                                            <p class="card-text card-remove-gap">-</p>
                                        @else
                                            <p class="card-text card-remove-gap">Olvasói értékelés: {{ round($item->sum / $item->numberofratings, 1) }}/5</p>
                                        @endif
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
    if(session()->has('reservation')){
        echo "<script>alert('".session('reservation')."');</script>";
        session()->forget('reservation');
    }
?>

@endsection
