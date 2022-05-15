@extends('layouts.app')

<head>
    <title>{{ $books->title }}</title>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ $books->title }}</div>
                <div class="card-body">
                    <div class="book-conent-container mb-3">
                        <div>
                            <img class="this-book-image" src="{{ asset('/storage/pictures/'.$books->picture) }}">
                        </div>
                        <div>
                            <label for="title" class="pb-1 book_class_title">{{ $books->title }}</label><br>
                            <label for="writer" class="pb-1 book_class_ed">{{ $books->writer }}</label><br>
                            <label for="edition" class="pb-1">{{ $books->edition }} kiadás</label><br>
                            <span for="release" class="pb-1" style="font-weight: 500">Kiadás éve: </span><span class="pb-1">{{ $books->release }}</span><br>
                            <span for="publisher" class="pb-1" style="font-weight: 500">Kiadó: </span><span class="pb-1">{{ $books->publisher }}</span><br>
                            <span for="isbn" class="pb-1" style="font-weight: 500">ISBN: </span><span class="pb-1">{{ $books->isbn }}</span><br>
                            <p></p>
                            <span for="description" class="pb-1" style="font-weight: 500">Rövid leírás: </span><span class="pb-1">{{ $books->description }}</span><br>
                            <p></p>
                            @if ($books->numberofratings === 0)
                                <span class="pt-3 pb-3" style="font-weight: 500">Olvasói értékelés: -</span>
                            @else
                                <span class="pt-3 pb-3" style="font-weight: 500">Olvasói értékelés: </span><span class="pb-1">{{ round($books->sum / $books->numberofratings, 1) }}/5  -  ({{$books->numberofratings}} értékelés)</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="/reserveBook/{{ $books->id }}"><button class="btn btn-primary">Könyv foglalása</button></a>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
