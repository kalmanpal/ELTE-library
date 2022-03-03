@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Könyvek</div>
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
                            <th scope="col">Összes</th>
                            <th scope="col">Elérhető</th>
                          </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $item)
                                <tr id="{{ $item->id }}" href>
                                    <td>
                                        <img src="{{ asset('storage/app/'.$item->picture) }}" class="w-10">
                                    </td>
                                    <td>
                                    <a class="td_class" href="{{ url('edit-book/'.$item->id) }}">{{ $item->title }}</a>
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
                                        {{ $item->max_number }}
                                    </td>
                                    <td>
                                        {{ $item->available_number }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(session()->has('newBook')){
        echo "<script>alert('".session('newBook')."');</script>";
        session()->forget('newBook');
    }

    if(session()->has('bookUpdate')){
        echo "<script>alert('".session('bookUpdate')."');</script>";
        session()->forget('bookUpdate');
}
?>
@endsection
