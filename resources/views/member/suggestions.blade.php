@extends('layouts.app')

<head>
    <title>Ajánlottak</title>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Neked ajánljuk</div>
                <div class="card-body">


                            {{-- @foreach ($books as $item)
                                <tr id="{{ $item->id }}" href>
                                    <td>
                                        <img src="{{ asset('storage/app/pictures/'.$item->picture) }}" class="w-10">
                                        </td>
                                    <td>
                                    <a class="td_class" href="{{ url('book/'.$item->id) }}">{{ $item->title }}</a>
                                    </td>
                                    <td>
                                        {{ $item->isbn }}
                                    </td>
                                    <td>
                                        {{ $item->writer }}
                                    </td>
                                    <td>
                                        {{ $item->release }}
                                    </td>
                                    <td>
                                        {{ $item->edition }}
                                    </td>
                                </tr>
                            @endforeach --}}




                    <div class="webshop-container">
                        @foreach ($books as $item)
                            <a class="no-underline" href="{{ url('book/'.$item->id) }}">
                                <div class="card" style="width: 15rem;">
                                    <img class="book-image" src="{{ asset('/storage/pictures/'.$item->picture) }}" class="card-img-top" alt="...">
                                    <div class="card-body" style="height: 190px">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text card-remove-gap">{{ $item->isbn }}</p>
                                        <p class="card-text card-remove-gap">{{ $item->writer }}</p>
                                        <p class="card-text card-remove-gap">{{ $item->release }}</p>
                                        @if ($item->numberofratings === 0)
                                            <p class="card-text card-remove-gap">-</p>
                                        @else
                                            <p class="card-text card-remove-gap">Olvasói értékelés: {{ $item->sum / $item->numberofratings }}/5</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            {{$books->links()}}
        </div>
    </div>
</div>

@endsection
