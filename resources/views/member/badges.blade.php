@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Jelvények</div>
                <div class="card-body">

                    <div class="badge-container">
                        <div class="nameofbadge ml-2">
                            <p class="badge-text">5 kölcsönzés
                                @if ($data[0] >= 5)
                                    <img src="https://cdn2.iconfinder.com/data/icons/basic-flat-icon-set/128/tick-256.png" style="width: 25px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                                @endif
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{$data[0]*20}}%;" aria-valuenow="{{$data[0]}}" aria-valuemin="0" aria-valuemax="5"></div>
                            </div>
                            <div class="icon">
                                @if ($data[0] >= 5)
                                    <img src="https://cdn3.iconfinder.com/data/icons/medals-grade-filled/96/BronzeMedal_v4-512.png" style="width: 40px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">10 kölcsönzés
                                @if ($data[0] >= 10)
                                    <img src="https://cdn2.iconfinder.com/data/icons/basic-flat-icon-set/128/tick-256.png" style="width: 25px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                                @endif
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{$data[0]*10}}%;" aria-valuenow="{{$data[0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                @if ($data[0] >= 10)
                                    <img src="https://cdn3.iconfinder.com/data/icons/medals-grade-filled/96/SilverMedal_v4-512.png" style="width: 40px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">20 kölcsönzés
                                @if ($data[0] >= 20)
                                    <img src="https://cdn2.iconfinder.com/data/icons/basic-flat-icon-set/128/tick-256.png" style="width: 25px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                                @endif
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{$data[0]*5}}%;" aria-valuenow="{{$data[0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                @if ($data[0] >= 20)
                                    <img src="https://cdn3.iconfinder.com/data/icons/medals-grade-filled/96/GoldMedal_v4-512.png" style="width: 40px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">Nincs késés!
                                @if ($data[1] >= 10)
                                    <img src="https://cdn2.iconfinder.com/data/icons/basic-flat-icon-set/128/tick-256.png" style="width: 25px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                                @endif
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{$data[1]*10}}%;" aria-valuenow="{{$data[1]}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                @if ($data[1] >= 10)
                                    <img src="https://cdn3.iconfinder.com/data/icons/seo-marketing-flat-circle-vol-3/96/Calendar_check_date_select-512.png" style="width: 40px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">Évforduló
                                @if ($data[2] >= 2)
                                    <img src="https://cdn2.iconfinder.com/data/icons/basic-flat-icon-set/128/tick-256.png" style="width: 25px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                                @endif
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{$data[2]*50}}%;" aria-valuenow="{{$data[2]}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                @if ($data[2] >= 2)
                                    <img src="https://cdn3.iconfinder.com/data/icons/anniversary-badge/128/ic_cake_1-256.png" style="width: 40px" alt="">
                                @else
                                    <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    var progressBar1 = $('.progress');
    var progressNumber1 =  50;

    progressBar1.css('width', progressNumber1 + '%');
    progressBar1.attr('aria-valuenow', progressNumber1);

</script> --}}




@endsection





