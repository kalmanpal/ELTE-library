@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Elérhető könyvek</div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Cím</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Író</th>
                            <th scope="col">Kiadás éve</th>
                            <th scope="col">Kiadás</th>
                            <th scope="col">Leírás</th>
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
                                    <td>
                                        {{ $item->description }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>



                </div>
            </div>
        </div>
    </div>
</div>

@endsection
