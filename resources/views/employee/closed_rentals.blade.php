@extends('layouts.app')

<head>
    <title>Lezárt kölcsönzések</title>
</head>

@section('content')

<?php
    use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Lezárt Kölcsönzések</div>
                <div class="card-body">
                    @if ($rentals->isEmpty())
                        <div>Még nincsenek lezárt kölcsönzések.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Név</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Cím</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Kiadás dátuma</th>
                                    <th scope="col">Határidő</th>
                                    <th scope="col">Visszavétel dátuma</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($rentals as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->out_date }}</td>
                                        <td>{{ $item->deadline }}</td>
                                        <td>{{ $item->in_date }}</td>
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
    {{$rentals->links()}}
</div>

@endsection
