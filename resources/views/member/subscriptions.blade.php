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
                    <div class="sub-container">
                        <div>
                            <p>Összes hónap: {{$allSubs[0]->all_months}}</p>
                            @if ($allSubs[0]->active === 1)
                                <p>Előfizetés: Aktív, eddig: {{$allSubs[0]->subexpiry}}</p>
                            @else
                                <p>Előfizetés: Inaktív</p>
                            @endif
                        </div>
                        <div>
                            <p>Tartozás: {{$allSubs[0]->plus_charge}} Ft</p>
                            <p>Kedvezmények: {{$allSubs[0]->discounts}}%</p>
                        </div>
                    </div>

                    <table class="table">
                        <h6>Korábbi előfizetések</h6>
                        <th>Kezdés</th>
                        <th>Lejárat</th>
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
