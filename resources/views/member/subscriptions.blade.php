@extends('layouts.app')

<head>
    <title>Előfizetéseim</title>
</head>

@section('content')

<?php
    use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Előfizetéseim</div>
                    <div class="card-body">
                        @if ($oldSubs->isEmpty())
                            <div>Még nem voltál előfizető.</div>
                        @else
                            <div class="sub-container">
                                <div>
                                    <span style="font-weight: 500">Összes hónap: </span><span>{{$allSubs[0]->all_months}}</span>
                                    <p></p>
                                    @if ($allSubs[0]->active === 1)
                                        <span style="font-weight: 500">Előfizetés: </span><span>Aktív, eddig: </span><span style="font-weight: 500">{{$allSubs[0]->subexpiry}}</span>
                                        <p></p>
                                    @else
                                        <span style="font-weight: 500">Előfizetés: </span><span>Inaktív</span>
                                        <p></p>
                                    @endif
                                </div>
                                <div>
                                    <span style="font-weight: 500">Tartozás: </span><span>{{$allSubs[0]->plus_charge}} Ft</span>
                                    <p></p>
                                    <span style="font-weight: 500">Kedvezmények: </span><span>{{$allSubs[0]->discounts}}%</span>
                                    <p></p>
                                </div>
                            </div>

                            <table class="table">
                                <h6>Korábbi előfizetések</h6>
                                <th>Kezdés</th>
                                <th>Lejárat</th>
                                <th>Státusz</th>
                                <th>Fizetve</th>
                                <tbody>
                                    @foreach ($oldSubs as $item)
                                        <tr>
                                            <td>{{ $item->from }}</td>
                                            <td>{{ $item->to }}</td>
                                            @if ($item->to >= Carbon::today())
                                                <td style="font-weight: 600; color: green">Aktív</td>
                                            @else
                                                <td style="color: red">Lejárt</td>
                                            @endif
                                            <td data-toggle="popover" title="Díjszámítás" data-trigger="hover focus" data-content="Alapdíj={{ $allSubs[0]->price }}Ft, kedvezmény felhasználva={{ $item->discount }}%, késedelmi díjak={{ $item->plusfee }}Ft.">{{ $item->paidfee }}</td>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

<script>
    var popoverTriggerList = [].slice.call( document.querySelectorAll( '[data-toggle="popover"]' ) );
    var popoverList = popoverTriggerList.map( function( popoverTrigger )
    {
        return new bootstrap.Popover( popoverTrigger );
    } );
</script>

@endsection
