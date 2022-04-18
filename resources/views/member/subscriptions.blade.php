@extends('layouts.app')
@section('content')

<?php
    use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Előfizetéseim</div>
                <div class="card-body">

                    <h6>Összes hónap: {{$allSubs[0]->all_months}}</h6>
                    <h6>Státusz: Aktív</h6>
                    <p></p>
                    <h6>Kedvezmények: ---------</h6>
                    <h6>Fizetnivalók: ---------</h6>
                    <p></p>
                    <table class="table">

                        <tbody>
                            @foreach ($oldSubs as $item)
                        <tr>
                            <td>{{ $item->from }}</td>
                            <td>{{ $item->to }}</td>
                        </tr>
                    @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
