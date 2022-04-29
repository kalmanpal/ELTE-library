@extends('layouts.app')
@section('content')

<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Keresés találatok
                </div>
                <div class="card-body">
                        <div class="webshop-container">
                            @foreach ($booksSearchedByEmp as $item)
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
    {{$booksSearchedByEmp->links()}}
</div>

@endsection
