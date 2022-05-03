@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
                                <input id="title" type="text" class="form-control" name="title" value="{{ $books->title }}" required maxlength="50">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="writer" class="col-md-4 col-form-label text-md-end">Író</label>
                            <div class="col-md-6">
                                <input id="onlyLettersWriter" type="text" class="form-control" name="writer" value="{{ $books->writer }}" require maxlength="60">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="publisher" class="col-md-4 col-form-label text-md-end">Kiadó</label>
                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control" name="publisher" value="{{ $books->publisher }}" required maxlength="30">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="release" class="col-md-4 col-form-label text-md-end">Kiadás éve</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="release" value="{{ $books->release }}" id="onlyNumbersRelease" required minlength="4" maxlength="4">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="edition" class="col-md-4 col-form-label text-md-end">Kiadás</label>
                            <div class="col-md-6">
                                <input id="edition" type="text" class="form-control" name="edition" value="{{ $books->edition }}" required minlength="2" maxlength="15">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Leírás</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" required maxlength="1000">{{ $books->description }}</textarea>
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
                                <input type="text" class="form-control" name="max_number" value="{{ $stocks->max_number }}" required id="onlyNumbersStock" minlength="1" maxlength="3">
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Módosítás" class="btn btn-primary">
                            </div>
                        </div>
                    </form>

                    <p></p>

                    <form method="GET" action="/rent/{{$books->id}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="rent" class="col-md-4 col-form-label text-md-end">Kölcsönző email címe</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mail" required>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Könyv kiadása" class="btn btn-primary">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#onlyLettersWriter').keydown(function (e) {
            if ( e.ctrlKey || e.altKey) {
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if (((key >=48) && (key <=57)) ||  (key == 190) || ((key >=96) && (key <=111))) {
                    e.preventDefault();
                }
            }
        });
    });

    $(function() {
        $('#onlyNumbersRelease').keydown(function (f) {
            if (f.ctrlKey || f.altKey || f.shiftKey) {
                f.preventDefault();
            } else {
                var key = f.keyCode;
                if ( !((key >= 48) && (key <=57)) && !((key >= 96) && (key <=105)) && !((key >= 37) && (key <=40)) && !(key == 8)) {
                    f.preventDefault();
                }
            }
        });
    });

    $(function() {
        $('#onlyNumbersStock').keydown(function (h) {
            if (h.ctrlKey || h.altKey || h.shiftKey) {
                h.preventDefault();
            } else {
                var key = h.keyCode;
                if ( !((key >= 48) && (key <=57)) && !((key >= 96) && (key <=105)) && !((key >= 37) && (key <=40)) && !(key == 8)) {
                    h.preventDefault();
                }
            }
        });
    });

</script>

@endsection
