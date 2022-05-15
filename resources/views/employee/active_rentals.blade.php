@extends('layouts.app')
@section('content')

<?php
    use Carbon\Carbon;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form type="get" method="GET" action="{{ url('/emp-search-rents-results') }}" >
                        @csrf
                        <div class="searchbar-container">
                            <div>
                                Aktív kölcsönzések
                            </div>
                            <div>
                                <input class="text-input-area"  type="search"  name="emp-rents-query" placeholder="Itt kereshet..." required>
                                <button type="submit" class="search-button">Keresés</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if ($rentals->isEmpty())
                        <div>Jelenleg nincsenek aktív kölcsönzések.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Kölcsönző</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Könyv</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Kiadás dátuma</th>
                                    <th scope="col">Határidő</th>
                                    <th scope="col"></th>
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
                                            <td><a href="book-is-back/{{ $item->id }}"><button class="btn btn-primary btn-sm">Könyv visszavétel(KÉSÉS)</button></a></td>
                                        @else
                                            <td><a href="book-is-back/{{ $item->id }}"><button class="btn btn-primary btn-sm">Könyv visszavétel</button></a></td>
                                        @endif
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
    {{$rentals->links()}}
</div>

<?php
    if(session()->has('rent')){
        echo "<script>alert('".session('rent')."');</script>";
        session()->forget('rent');
    }
?>

@endsection
