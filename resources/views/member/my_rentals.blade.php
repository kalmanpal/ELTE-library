@extends('layouts.app')
@section('content')

<?php
    use Carbon\Carbon;

    $szevasz = "ide-kellene-az-adott-sor-idje";
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Kölcsönzéseim</div>
                <div class="card-body">


                    @if ($rentals->isEmpty())
                        <div>Jelenleg nincsenek könyvek nálad.</div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Cím</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Kölcsönzés dátuma</th>
                                    <th scope="col">Határidő</th>
                                    <th scope="col">Visszahozva</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rentals as $item)
                                        <tr id="thisRent">
                                            @if (isset($item->in_date))
                                                <td>
                                                    <a class="td_class" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">{{ $item->title }}</a>
                                                </td>
                                            @else
                                                <td>{{ $item->title }}</td>
                                            @endif
                                            <td>{{ $item->isbn }}</td>
                                            <td>{{ $item->out_date }}</td>
                                            <td>{{ $item->deadline }}</td>
                                            @if (!!$item->in_date)
                                                <td style="color: green">{{ $item->in_date }}</td>
                                            @elseif ($item->deadline < Carbon::today())
                                                <td style="color: red">Még nálad van(KÉSÉS)</td>
                                            @else
                                                <td style="color: orange">Még nálad van</td>
                                            @endif

                                        </tr>
                                @endforeach
                            </tbody>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hogy tetszett a könyv?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="emote-container">

                    <a href="{{route('book.rating',['id'=>$szevasz,'rating'=> 1])}}">
                        <img src="https://cdn4.iconfinder.com/data/icons/emojis-flat-pixel-perfect/64/emoji-55-512.png" alt="" width="80px">
                    </a>

                    <a href="{{route('book.rating',['id'=>$szevasz,'rating'=> 2])}}">
                        <img src="https://cdn4.iconfinder.com/data/icons/emojis-flat-pixel-perfect/64/emoji-33-512.png" alt="" width="80px">
                    </a>

                    <a href="{{route('book.rating',['id'=>$szevasz,'rating'=> 3])}}">
                        <img src="https://cdn4.iconfinder.com/data/icons/emojis-flat-pixel-perfect/64/emoji-07-512.png" alt="" width="80px">
                    </a>

                    <a href="{{route('book.rating',['id'=>$szevasz,'rating'=> 4])}}">
                        <img src="https://cdn4.iconfinder.com/data/icons/emojis-flat-pixel-perfect/64/emoji-05-512.png" alt="" width="80px">
                    </a>

                    <a href="{{route('book.rating',['id'=>$szevasz,'rating'=> 5])}}">
                        <img src="https://cdn4.iconfinder.com/data/icons/emojis-flat-pixel-perfect/64/emoji-03-512.png" alt="" width="80px">
                    </a>

                </div>
            </div>
        </div>
    </div>




@endsection
