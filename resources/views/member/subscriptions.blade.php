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
                    @if ($allSubs[0]->active === 1)
                        <h6>Előfizetés: Aktív, eddig: {{$allSubs[0]->subexpiry}}</h6>
                    @else
                        <h6>Előfizetés: Inaktív</h6>
                    @endif

                    <p></p>
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
