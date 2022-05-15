@extends('layouts.app')

<head>
    <title>Foglalásaim</title>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Foglalásaim</div>
                <div class="card-body">
                    @if ($myreservations->isEmpty())
                        <div>Jelenleg nincsenek foglalásaid.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Könyv</th>
                                    <th scope="col">Író</th>
                                    <th scope="col">Kiadás éve</th>
                                    <th scope="col">ISBN</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($myreservations as $item)
                                    <tr id="{{ $item->id }}" href>

                                        <td >
                                            {{ $item->title }}
                                        </td>
                                        <td >
                                            {{ $item->writer }}
                                        </td>
                                        <td >
                                            {{ $item->release }}
                                        </td>
                                        <td >
                                            {{ $item->isbn }}
                                        </td>
                                        <td>
                                            <a href="/deleteReservation/{{ $item->id }}"><button class="btn btn-primary btn-sm">Foglalás törlése</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
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
