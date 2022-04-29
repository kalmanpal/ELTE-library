@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $books->title }}</div>

                <div class="card-body">

                            <div class="row">
                              <div class="col-7">
                                <img src="{{ asset('/storage/pictures/'.$books->picture) }}">
                              </div>
                              <div class="col-5">
                                <label for="ISBN" class="pb-2">ISBN : {{ $books->isbn }}</label><br>
                                <label for="title" class="pb-1 book_class_title">{{ $books->title }}</label><br>
                                <label for="edition" class="pb-2 book_class_ed">{{ $books->edition }} kiadás</label><br>
                                <label for="writer" class="pb-1">{{ $books->writer }}</label><br>
                                <label for="publisher" class="pb-1">Kiadó: {{ $books->publisher }}</label><br>
                                <label for="release" class="pb-1">{{ $books->release }}</label><br>
                                <label for="description" class="pb-1">Leírás: {{ $books->description }}</label><br>
                                <label for="description" class="pt-3 pb-3">Értékelés: {{ $books->rating }}/10</label>
                              </div>
                            </div>


                        {{-- @if($books->image)
                            <img src="{{ asset('storage/app/pictures/'.$books->image) }}" alt="">
                        @endif
                        <div class="row mb-3">
                            <label for="picture" class="col-md-4 col-form-label text-md-end">Fénykép</label>
                            <div class="col-md-6">
                                <input class="form-control" id="picture" type="file" name="picture">
                            </div>
                        </div> --}}

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
