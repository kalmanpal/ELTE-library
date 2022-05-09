@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Új könyv hozzáadása</div>

                <div class="card-body">
                    <form method="POST" action="newbook" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="ISBN" class="col-md-4 col-form-label text-md-end">ISBN</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="isbn" required minlength="10" maxlength="13">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Cím</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required maxlength="50">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="writer" class="col-md-4 col-form-label text-md-end">Író</label>
                            <div class="col-md-6">
                                <input id="onlyLettersWriter" type="text" class="form-control" name="writer" required maxlength="60">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="publisher" class="col-md-4 col-form-label text-md-end">Kiadó</label>
                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control" name="publisher" required maxlength="30">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="release" class="col-md-4 col-form-label text-md-end">Kiadás éve</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="release" id="onlyNumbersRelease" required minlength="4" maxlength="4">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="edition" class="col-md-4 col-form-label text-md-end">Kiadás</label>
                            <div class="col-md-6">
                                <input id="edition" type="text" class="form-control" name="edition" required minlength="2" maxlength="15">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Leírás</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" required maxlength="1000"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">Kategória</label>
                            <div class="col-md-6">
                                <select class="form-select" name="category" required>
                                    <option selected style="color: lightgrey">Válassz...</option>
                                    <option value="LT">Életstílus</option>
                                    <option value="F">Gasztro</option>
                                    <option value="KID">Gyerek</option>
                                    <option value="LIT">Irodalom</option>
                                    <option value="COM">Képregény</option>
                                    <option value="CLA">Klasszikus</option>
                                    <option value="ART">Művészet</option>
                                    <option value="FIN">Pénzügy</option>
                                    <option value="S">Sport</option>
                                    <option value="L">Tanulás</option>
                                    <option value="TEC">Technológia</option>
                                    <option value="H">Történelem</option>
                                    <option value="TRA">Utazás</option>
                                    <option value="REL">Vallás</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="picture" class="col-md-4 col-form-label text-md-end">Fénykép</label>
                            <div class="col-md-6">
                                <input class="form-control" id="picture" type="file" name="picture" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="max_number" class="col-md-4 col-form-label text-md-end">Könyvek száma</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="max_number" required id="onlyNumbersStock" minlength="1" maxlength="3" >
                            </div>
                        </div>

                        <div class="cb-register mb-2">
                            <input class="cb-size" type="checkbox" id="" name="send_email" value="send_email">
                            <label class="cb-text" for="send_email">Értesítő email küldése a könyv érkezéséről.</label><br>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Hozzáad" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(session()->has('newBookFailed')){
    echo "<script>alert('".session('newBookFailed')."');</script>";
    session()->forget('newBookFailed');
}
?>

<script>
    $(function() {
        $('#onlyLettersWriter').keydown(function (e) {
            if (e.altKey) {
                e.preventDefault();
            } else {
                var key = e.keyCode;
                if (((key >=48) && (key <=57)) ||  (key == 190) || ((key >=96) && (key <=111))) {
                    e.preventDefault();
                }
            }
        });
    });

    $(function() {
        $('#onlyNumbersRelease').keydown(function (f) {
            if (f.ctrlKey || f.altKey || f.shiftKey) {
                f.preventDefault();
            } else {
                var key = f.keyCode;
                if ( !((key >= 48) && (key <=57)) && !((key >= 96) && (key <=105)) && !((key >= 37) && (key <=40)) && !(key == 8)) {
                    f.preventDefault();
                }
            }
        });
    });

    $(function() {
        $('#onlyNumbersStock').keydown(function (h) {
            if (h.ctrlKey || h.altKey || h.shiftKey) {
                h.preventDefault();
            } else {
                var key = h.keyCode;
                if ( !((key >= 48) && (key <=57)) && !((key >= 96) && (key <=105)) && !((key >= 37) && (key <=40)) && !(key == 8)) {
                    h.preventDefault();
                }
            }
        });
    });

</script>

@endsection
