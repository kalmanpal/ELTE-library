@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Találatok
                </div>
                <div class="card-body">
                    @if ($resSearched->isEmpty())
                        <div>Jelenleg nincsenek foglalások.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Foglaló</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Könyv</th>
                                    <th scope="col">ISBN</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resSearched as $item)
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
    {{$resSearched->links()}}
</div>

@endsection
