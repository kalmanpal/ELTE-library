@extends('layouts.app')

@section('content')

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
                                <input id="ISBN" type="text" class="form-control" name="isbn" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Cím</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="writer" class="col-md-4 col-form-label text-md-end">Író</label>
                            <div class="col-md-6">
                                <input id="writer" type="text" class="form-control" name="writer" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="publisher" class="col-md-4 col-form-label text-md-end">Kiadó</label>
                            <div class="col-md-6">
                                <input id="publisher" type="text" class="form-control" name="publisher" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="release" class="col-md-4 col-form-label text-md-end">Kiadás éve</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="release" id="release" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="edition" class="col-md-4 col-form-label text-md-end">Kiadás</label>
                            <div class="col-md-6">
                                <input id="edition" type="text" class="form-control" name="edition" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Leírás</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="description" required></textarea>
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
                                <input type="text" class="form-control" name="max_number" required>
                            </div>
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

@endsection
