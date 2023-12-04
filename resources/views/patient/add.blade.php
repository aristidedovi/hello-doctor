@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')

      <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                        <div class="col-md-12">
                            <!-- Card -->
                            <div class="card">
                                <div class="card-body">
                                    {{-- <h4 class="card-title">Formulaire d'ajout de patient</h4>
                                    <h6 class="card-subtitle">Remplire toutes les informations demandées dans le formulaire.</h6>
                                    <div class="row form-material">
                                        <div class="col-md-6">
                                            <label class="m-t-20">Date du rendez-vous</label>
                                            <input type="text" class="form-control" placeholder="2017-06-04" id="mdate">
                                            <label class="m-t-40">Default Material Date Timepicker</label>
                                            <input type="text" id="date-format" class="form-control" placeholder="Saturday 24 June 2017 - 21:44">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="m-t-20">Time Picker</label>
                                            <input class="form-control" id="timepicker" placeholder="Check time">
                                            <label class="m-t-40">Min Date set</label>
                                            <input type="text" class="form-control" placeholder="set min date" id="min-date">
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Formulaire d'ajout de patient</h4>
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="basic-form">
                                                    <form method="post" action="{{ route('patient.store') }}">
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Nom</label>
                                                                <input type="text" name="last_name" class="form-control" placeholder="Nom">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Prénom</label>
                                                                <input type="text" name="first_name" class="form-control" placeholder="Prénom">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Adresse</label>
                                                                <input type="text" name="address" class="form-control" placeholder="Colobane, Dakar-Sénégal">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label>Téléphone</label>
                                                                <input type="text" name="phone" class="form-control" placeholder="77-777-77-77">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label>Age</label>
                                                                <input type="text" name="age" class="form-control" placeholder="77">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label>Genre</label>
                                                                <select id="inputState" name="genre" class="form-control">
                                                                    <option selected="selected">Choisir...</option>
                                                                    <option>Homme</option>
                                                                    <option>Femme</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-dark">Enregistrer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card -->
                        </div>
                </div>
            </div>    
        </div>
@endsection
