@extends('layouts.app')

<?php
    use Carbon\Carbon;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<head>
    <title>{{$member->name}}</title>
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $member->name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('update-member-data/'.$member->id) }}" id="mentes-form">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Név</label>
                            <div class="col-md-6">
                                <input class="form-control" name="name" value="{{ $member->name }}" required minlength="3" maxlength="35"  autofocus id="onlyLettersName">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input class="form-control" name="email" value="{{ $member->email }}" readonly>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">Település</label>
                            <div class="col-md-6">
                                <input class="form-control " name="city" value="{{ $member->city }}" required minlength="2" maxlength="30" id="onlyLettersCity">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Cím</label>
                            <div class="col-md-6">
                                <input class="form-control" name="address" value="{{ $member->address }}" required minlength="3" maxlength="40">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">Tagság típusa</label>
                            <div class="col-md-6">
                                <select class="form-select" name="type" required>
                                    <option selected style="color: lightgrey" value="{{ $member->type }}">{{ $member->type }}</option>
                                    <option value="ES">ELTE hallgató</option>
                                    <option value="ET">ELTE oktató</option>
                                    <option value="O">Egyéb</option>
                                    <option value="E">Emp</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <form method="GET" action="/activate/{{$member->id}}" id="hiteles-form">
                        @csrf

                    </form>

                    <div class="asd">
                        <div class="row mb-0">
                            <div class="">
                                <input form="mentes-form" type="submit" value="Mentés" class="btn btn-primary">
                            </div>
                        </div>

                        @if ($isActive[0]->active === 0)
                            <div class="row mb-0">
                                <div class="">
                                    <input form="hiteles-form" type="submit" value="Adatok hitelesek, előfizetés indítása" class="btn btn-success">
                                </div>
                            </div>
                        @endif
                    </div>

                    <p></p>

                    @if ($isActive[0]->all_months != 0)
                        <h5>Előfizetések</h5>

                        <div class="sub-container">
                            <p>Tartozás: {{$isActive[0]->plus_charge}} Ft</p>
                            <p>Kedvezmények: {{$isActive[0]->discounts}}%</p>
                        </div>

                        <table class="table">
                            <tbody>
                                <th>
                                    Előfizetés kezdete
                                </th>
                                <th>
                                    Előfizetés lejárta
                                </th>
                                <th>
                                    Státusz
                                </th>
                                <th>
                                    Fizetve
                                </th>
                                @foreach ($subs as $item)
                                    <tr>
                                        <td>
                                            {{ $item->from }}
                                        </td>
                                        <td>
                                            {{ $item->to }}
                                        </td>
                                        <td>
                                            @if ($item->to >= Carbon::today())
                                                Aktív
                                            @else
                                                Lejárt
                                            @endif
                                        </td>
                                        <td data-toggle="popover" title="Díjszámítás" data-trigger="hover focus" data-content="Alapdíj={{ $isActive[0]->price }}Ft, kedvezmény felhasználva={{ $item->discount }}%, késedelmi díjak={{ $item->plusfee }}Ft.">
                                            {{ $item->paidfee }} Ft
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

<script>
    $(function() {
        $('#onlyLettersName').keydown(function (e) {
            if ( e.ctrlKey || e.altKey) {
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if (((key >=48) && (key <=57)) ||  (key == 190) || ((key >=96) && (key <=111))) {
                    e.preventDefault();
                }
            }
        });
    });

    $(function() {
        $('#onlyLettersCity').keydown(function (f) {
            if (f.ctrlKey || f.altKey) {
                f.preventDefault();
            } else {
                var key = f.keyCode;
                if (((key >=48) && (key <=57)) ||  (key == 190) || ((key >=96) && (key <=111))) {
                    f.preventDefault();
                }
            }
        });
    });
</script>

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
