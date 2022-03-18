@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Foglalásaim</div>
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
                            <th></th>
                          </tr>
                        </thead>

                        <tbody>
                            @foreach ($myreservations as $item)
                                <tr id="{{ $item->id }}" href>
                                    <td>
                                        <img src="{{ asset('storage/app/pictures/'.$item->picture) }}" class="w-10">
                                        </td>
                                    <td class="myRes">
                                        {{ $item->title }}
                                    </td>
                                    <td class="myRes">
                                        {{ $item->isbn }}
                                    </td>
                                    <td class="myRes">
                                        {{ $item->writer }}
                                    </td>
                                    <td class="myRes">
                                        {{ $item->release }}
                                    </td>
                                    <td class="myRes">
                                        {{ $item->edition }}
                                    </td>
                                    <td>
                                        <a href="/deleteReservation/{{ $item->id }}"><button class="btn btn-primary">Foglalás törlése</button></a>
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
    if(session()->has('reservation')){
        echo "<script>alert('".session('reservation')."');</script>";
        session()->forget('reservation');
    }

    if(session()->has('deleteReservation')){
        echo "<script>alert('".session('deleteReservation')."');</script>";
        session()->forget('deleteReservation');
    }
?>
@endsection