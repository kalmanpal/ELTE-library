@extends('layouts.app')
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
                                    <th >Foglaló</th>
                                    <th >Email</th>
                                    <th >Könyv</th>
                                    <th >ISBN</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $item)
                                    <tr id="{{ $item->id }}" href>
                                        <td >
                                            {{ $item->name }}
                                        </td>
                                        <td >
                                            {{ $item->email }}
                                        </td>
                                        <td >
                                            {{ $item->title }}
                                        </td>
                                        <td >
                                            {{ $item->isbn }}
                                        </td>
                                        <td>
                                            <a  href="rent-from-res/{{ $item->id }}"><button class="btn btn-primary btn-sm">Könyv kiadása</button></a>
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
