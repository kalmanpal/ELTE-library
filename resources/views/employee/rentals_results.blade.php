@extends('layouts.app')

<head>
    <title>Aktív kölcsönzések</title>
</head>

@section('content')

<?php
    use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Aktív kölcsönzések</div>
                <div class="card-body">
                    @if ($rentsSearched->isEmpty())
                        <div>Jelenleg nincsenek aktív kölcsönzések.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Kölcsönző</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Könyv</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Kiadás dátuma</th>
                                    <th scope="col">Határidő</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($rentsSearched as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->out_date }}</td>
                                        <td>{{ $item->deadline }}</td>
                                        @if ($item->deadline < Carbon::today())
                                            <td><a href="book-is-back/{{ $item->id }}"><button class="btn btn-primary btn-sm">Könyv visszavétel(KÉSÉS)</button></a></td>
                                        @else
                                            <td><a href="book-is-back/{{ $item->id }}"><button class="btn btn-primary btn-sm">Könyv visszavétel</button></a></td>
                                        @endif
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

<div class="paginate-container">
    {{$rentsSearched->links()}}
</div>

<?php
    if(session()->has('rent')){
        echo "<script>alert('".session('rent')."');</script>";
        session()->forget('rent');
    }
?>

@endsection
