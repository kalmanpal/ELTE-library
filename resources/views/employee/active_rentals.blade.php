@extends('layouts.app')
@section('content')

<?php
    use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Aktív kölcsönzések</div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Név</th>
                            <th scope="col">Email</th>
                            <th scope="col">Cím</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Kiadás dátuma</th>
                            <th scope="col">Határidő</th>
                            <th scope="col"></th>
                            <th></th>
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
                            @if ($item->deadline < Carbon::today())
                                <td><a href="book-is-back/{{ $item->id }}"><button class="btn btn-primary">Könyv visszavétel(KÉSÉS)</button></a></td>
                            @else
                                <td><a href="book-is-back/{{ $item->id }}"><button class="btn btn-primary btn-sm">Könyv visszavétel</button></a></td>
                            @endif
                        </tr>
                    @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
