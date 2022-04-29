@extends('layouts.app')
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
                        @endif
                </div>
            </div>
            {{$booksSearchedByMem->links()}}
        </div>
    </div>
</div>

@endsection