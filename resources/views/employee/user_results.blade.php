@extends('layouts.app')

<head>
    <title>Felhasználók</title>
</head>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Keresés találatok</div>
                <div class="card-body">
                    @if ($usersSearched->isEmpty())
                        <div>Nincs Találat.</div>
                    @else
                        <table class="table">
                            <tbody>
                                @foreach ($usersSearched as $item)
                                    <tr id="{{ $item->id }}">
                                        <td>
                                            <a class="td_class" href="{{ url('member/'.$item->id) }}">{{ $item->name }}</a>
                                        </td>
                                        <td>
                                            {{ $item->email }}
                                        </td>
                                        <td>
                                            {{ $item->city }}
                                        </td>
                                        <td>
                                            {{ $item->address }}
                                        </td>
                                        @if ( $item->type  === 'ES')
                                        <td>ELTE hallgató</td>
                                        @endif
                                        @if ( $item->type  === 'ET')
                                            <td>ELTE oktató</td>
                                        @endif
                                        @if ( $item->type  === 'O')
                                            <td>Egyéb</td>
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

@endsection
