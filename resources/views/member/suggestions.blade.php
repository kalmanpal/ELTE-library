@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
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




                        <div class="container">
                            <div class="row">
                              <div class="col">
                                @foreach ($books as $item)
                                    <div class="card" style="width: 18rem;">
                                        <img src="https://s04.static.libri.hu/cover/f0/3/1243841_5.jpg" height="250" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->title }}</h5>
                                            <p class="card-text">{{ $item->isbn }}</p>
                                            <p class="card-text">{{ $item->writer }}</p>
                                            <p class="card-text">{{ $item->edition }}</p>
                                            <p class="card-text">{{ $item->release }}</p>
                                        </div>
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
