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
                                    <th scope="col">Cím</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Író</th>
                                    <th scope="col">Foglaló</th>
                                    <th scope="col">Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resSearched as $item)
                                    <tr id="{{ $item->id }}" href>

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
    {{$resSearched->links()}}
</div>

@endsection
