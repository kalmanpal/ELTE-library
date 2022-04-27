@extends('layouts.app')
@section('content')

<?php
    use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Kölcsönzéseim</div>
                <div class="card-body">


                    @if ($rentals->isEmpty())
                        <div>Jelenleg nincsenek könyvek nálad.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Cím</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Kölcsönzés dátuma</th>
                                    <th scope="col">Határidő</th>
                                    <th scope="col">Visszahozva</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rentals as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->out_date }}</td>
                                        <td>{{ $item->deadline }}</td>
                                        @if (!!$item->in_date)
                                            <td style="color: green">{{ $item->in_date }}</td>
                                        @elseif ($item->deadline < Carbon::today())
                                            <td style="color: red">Még nálad van(KÉSÉS)</td>
                                        @else
                                            <td style="color: orange">Még nálad van</td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
