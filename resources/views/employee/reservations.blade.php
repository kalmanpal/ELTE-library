@extends('layouts.app')

<head>
    <title>Foglalások</title>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <form type="get" method="GET" action="{{ url('/emp-search-res-results') }}" >
                        @csrf
                        <div class="searchbar-container">
                            <div>
                                Foglalások
                            </div>
                            <div>
                                <input class="text-input-area"  type="search"  name="emp-res-query" placeholder="Itt kereshet..." required>
                                <button type="submit" class="search-button">Keresés</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if ($reservations->isEmpty())
                        <div>Jelenleg nincsenek foglalások.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Cím</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Író</th>
                                    <th scope="col">Foglaló</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $item)
                                    <tr id="{{ $item->id }}" href>
                                        <td>
                                            <img src="{{ asset('storage/app/pictures/'.$item->picture) }}" class="w-10">
                                            </td>
                                        <td class="myRes">
                                            {{ $item->title }}
                                        </td>
                                        <td class="myRes">
                                            {{ $item->isbn }}
                                        </td>
                                        <td class="myRes">
                                            {{ $item->writer }}
                                        </td>
                                        <td class="myRes">
                                            {{ $item->name }}
                                        </td>
                                        <td class="myRes">
                                            {{ $item->email }}
                                        </td>
                                        <td>
                                            <a  href="rent-from-res/{{ $item->id }}"><button class="btn btn-primary">Könyv kiadása</button></a>
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

<div class="paginate-container">
    {{$reservations->links()}}
</div>

@endsection
