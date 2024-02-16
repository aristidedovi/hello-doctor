@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Formulaire de rendez-vous</h4>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Formulaire de rendez-vous</h4>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="basic-form">
                                            <form method="post" action="{{ route('appointment.store') }}">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="input-datalist">Code Patient*</label>
                                                        <input type="text" name="patient_id" class="form-control" placeholder="Code patient" list="list-patient" id="input-datalist" require>
                                                        <datalist id="list-patient">
                                                            @foreach ($patients as $patient)  
                                                            <option data-value='{{ $patient->id }}' value="{{ $patient->code }}"></option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Date du rendez-vous*</label>
                                                        <input type="text" name="date" class="form-control" placeholder="Saturday 24 June 2017 - 21:44" id="date-format" require>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <!-- <label>Status (select one)*:</label> -->
                                                        <select name="motif" class="form-control" id="sel1" hidden require>
                                                            <option value="en cours">En cours</option>
                                                            <option value="reprogrammer">reprogrammer</option>
                                                            <option value="cloturer">Cloturer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Code patient</label>
                                                        <input type="text" name="last_name" class="form-control" placeholder="Nom">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Prénom</label>
                                                        <input type="text" name="first_name" class="form-control" placeholder="Prénom">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Adresse</label>
                                                        <input type="text" name="address" class="form-control" placeholder="Colobane, Dakar-Sénégal">
                                                    </div>
                                                </div> -->
                                                <div class="form-row">
                                                    
                                                    <!-- <div class="form-group col-md-4">
                                                        <label>Téléphone</label>
                                                        <input type="text" name="phone" class="form-control" placeholder="77-777-77-77">
                                                    </div> -->
                        
                                                    <div class="form-group col-lg-12">
                                                        <label>Motif*:</label>
                                                        <textarea name="motif" class="form-control h-100px" rows="6" id="motif" require></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-row">
                                                    <!-- <div class="form-group col-lg-12">
                                                        <label>Motif:</label>
                                                        <textarea class="form-control h-100px" rows="6" id="comment"></textarea>
                                                    </div> -->
                                                    
                                                    {{-- <div class="form-group col-md-6">
                                                        <label>Status (select one):</label>
                                                        <select class="form-control" id="sel1">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                        </select>
                                                    </div> --}}
                                                    {{-- <div class="form-group col-md-4">
                                                        <label>State</label>
                                                        <select id="inputState" class="form-control">
                                                            <option selected="selected">Choose...</option>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>Zip</label>
                                                        <input type="text" class="form-control">
                                                    </div> --}}
                                                </div>
                                                {{-- <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox">
                                                        <label class="form-check-label">Check me out</label>
                                                    </div>
                                                </div> --}}
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </form>
                                        </div>
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
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', e => {
        $('#input-datalist').autocomplete()
    }, false);
</script>
@endpush
@endsection
