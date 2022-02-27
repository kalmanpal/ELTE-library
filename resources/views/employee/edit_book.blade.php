@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $books->title }}</div>

                <div class="card-body">
                    <form action="{{ url('update-book/'.$books->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="ISBN" class="col-md-4 col-form-label text-md-end">ISBN</label>
                            <div class="col-md-6">
                                <input id="ISBN"class="form-control" value="{{ $books->isbn }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Cím</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $books->title }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="writer" class="col-md-4 col-form-label text-md-end">Író</label>
                            <div class="col-md-6">
                                <input id="writer" type="text" class="form-control" name="writer" value="{{ $books->writer }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="publisher" class="col-md-4 col-form-label text-md-end">Kiadó</label>
                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control" name="publisher" value="{{ $books->publisher }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="release" class="col-md-4 col-form-label text-md-end">Kiadás éve</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="release" id="release" value="{{ $books->release }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="edition" class="col-md-4 col-form-label text-md-end">Kiadás</label>
                            <div class="col-md-6">
                                <input id="edition" type="text" class="form-control" name="edition" value="{{ $books->edition }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Leírás</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" required>{{ $books->description }}</textarea>
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

                        <div class="row mb-3">
                            <label for="max_number" class="col-md-4 col-form-label text-md-end">Könyvek száma</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="max_number" value="{{ $stocks->max_number }}" required>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Módosítás" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
