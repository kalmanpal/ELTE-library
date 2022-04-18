@extends('layouts.app')
<?php
    use Carbon\Carbon;
?>
<head>
    <title>Profil</title>
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $member->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('update-member-data/'.$member->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Név</label>

                            <div class="col-md-6">
                                <input class="form-control" name="name" value="{{ $member->name }}" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- --- --}}

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
                                <input class="form-control " name="city" value="{{ $member->city }}" required>

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
                                <input class="form-control" name="address" value="{{ $member->address }}" required>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div>Jelenlegi tagság típusa: {{ $member->type }}. Amennyiben változtatni akarsz, lenn megteheted.</div> --}}

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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Mentés" class="btn btn-primary">
                            </div>
                        </div>
                    </form>

                    @if ($isActive[0]->active === 0)
                        <form method="GET" action="/activate/{{$member->id}}">
                            @csrf
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Adatok hitelesek, előfizetés indítása" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    @endif

                    <p></p>

                    @if ($isActive[0]->all_months != 0)
                        <h5>Előfizetések</h5>
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
