@extends('layouts.app')

<head>
    <title>Ajánlottak</title>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Neked ajánljuk</div>
                <div class="card-body">
                    @if ($books->isEmpty())
                        <div>Böngéssz kicsit a könyvek közt, hogy megtudjuk miket szeretsz olvasni!</div>
                    @else
                        <div class="webshop-container">
                            @foreach ($books as $item)
                                <a class="no-underline" href="{{ url('book/'.$item->id) }}">
                                    <div class="card" style="width: 15rem;">
                                        <img class="book-image" src="{{ asset('/storage/pictures/'.$item->picture) }}" class="card-img-top" alt="...">
                                        <div class="card-body" style="height: 190px">
                                            <h5 class="card-title">{{ $item->title }}</h5>
                                            <p class="card-text card-remove-gap">{{ $item->isbn }}</p>
                                            <p class="card-text card-remove-gap">{{ $item->writer }}</p>
                                            <p class="card-text card-remove-gap">{{ $item->release }}</p>
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
                    @endif
                </div>
            </div>
            <div class="paginate-container">
                {{$books->links()}}
            </div>
        </div>
    </div>
</div>

@endsection
