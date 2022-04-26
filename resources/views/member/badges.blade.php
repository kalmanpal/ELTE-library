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
                                    <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="" data-toggle="popover" title="5 kölcsönzés" data-trigger="hover focus" data-content="A bronzérem feloldásához érj el 5 kölcsönzést. A jelvény feloldásával 5% kedvezmény érhető el, amit a következő előfizetésnél lehet felhasználni. A kedvezmények összeadódnak.">
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
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="" data-toggle="popover" title="10 kölcsönzés" data-trigger="hover focus" data-content="Az ezüstérem feloldásához érj el 10 kölcsönzést. A jelvény feloldásával 10% kedvezmény érhető el, amit a következő előfizetésnél lehet felhasználni. A kedvezmények összeadódnak.">
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
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="" data-toggle="popover" title="20 kölcsönzés" data-trigger="hover focus" data-content="Az aranyérem feloldásához érj el 20 kölcsönzést. A jelvény feloldásával 20% kedvezmény érhető el, amit a következő előfizetésnél lehet felhasználni. A kedvezmények összeadódnak.">
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
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="" data-toggle="popover" title="Nincs késés!" data-trigger="hover focus" data-content="A jelvény feloldáshoz érj el 10 késés nélkül visszahozott kölcsönzést. A jelvény feloldásával 5% kedvezmény érhető el, amit a következő előfizetésnél lehet felhasználni. A kedvezmények összeadódnak.">
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
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="" data-toggle="popover" title="Évforduló" data-trigger="hover focus" data-content="A jelvény feloldáshoz fizess elő 2 félévre. A jelvény feloldásával 10% kedvezmény érhető el, amit a következő előfizetésnél lehet felhasználni. A kedvezmények összeadódnak.">
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

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

<script>
    var popoverTriggerList = [].slice.call( document.querySelectorAll( '[data-toggle="popover"]' ) );
    var popoverList = popoverTriggerList.map( function( popoverTrigger )
    {
        return new bootstrap.Popover( popoverTrigger );
    } );
</script>



@endsection





