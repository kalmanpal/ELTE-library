@extends('layouts.app')

<head>
    <title>Könyvek</title>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Keresés találatok</div>
                <div class="card-body">
                    @if ($booksSearchedByMem->isEmpty())
                        <div>Nincs Találat.</div>
                    @else
                        <div class="webshop-container">
                            @foreach ($booksSearchedByMem as $item)
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
                    @endif
                </div>
            </div>
            {{$booksSearchedByMem->links()}}
        </div>
    </div>
</div>

@endsection
