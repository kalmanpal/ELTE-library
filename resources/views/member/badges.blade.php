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
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">10 kölcsönzés
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">20 kölcsönzés
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">Nincs késés!
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="badge-container mt-3">
                        <div class="nameofbadge">
                            <p class="badge-text">Évforduló
                                <img src="https://cdn2.iconfinder.com/data/icons/generic-06/100/Artboard_130-256.png" style="width: 25px" alt="">
                            </p>
                        </div>
                        <div class="bottom-container">
                            <div class="progress" style="width: 800px; height: 24px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="icon">
                                <img src="https://cdn2.iconfinder.com/data/icons/squircle-ui/32/Locked-256.png" style="width: 40px" alt="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });
    </script>
@endsection


