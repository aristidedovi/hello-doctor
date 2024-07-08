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
                        <div class="card">
                            <div class="card-body">
                                {{-- <h4 class="card-title">Tab with icon</h4> --}}
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <h4 class="card-title">Liste des patients</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="button" onclick="window.location='{{ route('patient.create') }}'" class="btn mb-1 btn-primary pull-right">
                                            Nouveau patient
                                            <span class="btn-icon-right"><i class="fa fa-plus"></i></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive"> 
                                    <table class="table table-bordered table-striped verticle-middle zero-configuration">
                                        <thead>
                                            <tr>
                                                <th scope="col">Code</th>
                                                <th scope="col">Nom Complet</th>
                                                <th scope="col">adresse</th>
                                                <th scope="col">Téléphone</th>
                                                <th scope="col">Date d'ajout</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patients as $patient)
                                            <tr>
                                                <td>
                                                    {{ $patient->code }}
                                                </td>
                                                <td>
                                                    {{ $patient->last_name }}
                                                    {{ $patient->first_name }}
                                                </td>
                                                <td>
                                                    {{ $patient->address }}
                                                </td>
                                                <td>
                                                    {{ $patient->phone }}
                                                </td>
                                                <td>
                                                    {{ $patient->created_at->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="dropdown show">
                                                                <a class="btn" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <span style="color: black">...</span>
                                                                </a>

                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a class="btn dropdown-item" href="{{ route('patient.detail', $patient) }}" data-toggle="tooltip" data-placement="top" title="Detail">
                                                                        Détail
                                                                    </a>
                                                                    <a class="btn dropdown-item sweet-success-cancel" data-url="{{ route('patient.delete', $patient) }}" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                                                        <span style="color: red;">Supprimer</span> 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <span>
                                                        <a href="{{ route('patient.detail', $patient) }}" data-toggle="tooltip" data-placement="top" title="Detail">
                                                            <i class="fa fa-eye color-muted m-r-5 mr-2"></i> 
                                                        </a>
                                                    </span>
                                                    <span class="sweetalert m-t-30">
                                                        <a class="sweet-success-cancel" data-url="{{ route('patient.delete', $patient) }}" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                                            <i class="fa fa-trash-o color-muted m-r-5" style="color: red;"></i> 
                                                        </a>
                                                    </span> -->
                                                </td>
                                            </tr>
                                                
                                            @endforeach
                                            {{-- <tr>
                                                <td>Air Conditioner</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-1" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>Apr 20,2018</td>
                                                <td><span class="label gradient-1 btn-rounded">70%</span>
                                                </td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Textiles</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>May 27,2018</td>
                                                <td><span class="label gradient-2 btn-rounded">70%</span>
                                                </td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Milk Powder</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-3" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>May 18,2018</td>
                                                <td><span class="label gradient-3 btn-rounded">70%</span>
                                                </td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Vehicles</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-4" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>Mar 27,2018</td>
                                                <td><span class="label gradient-4 btn-rounded">70%</span>
                                                </td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Boats</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-9" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>Jun 28,2018</td>
                                                <td><span class="label gradient-9 btn-rounded">70%</span>
                                                </td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Boats</td>
                                                <td>
                                                    <div class="progress" style="height: 10px">
                                                        <div class="progress-bar gradient-2" style="width: 70%;" role="progressbar"><span class="sr-only">70% Complete</span>
                                                        </div>
                                                    </div> 
                                                </td>
                                                <td>Aug 20,2018</td>
                                                <td><span class="label gradient-2 btn-rounded">70%</span>
                                                </td>
                                                <td><span><a href="#" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil color-muted m-r-5"></i> </a><a href="#" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a></span>
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@push('scripts')
    <script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/js/sweetalert.init.js') }}"></script>
@endpush
@endsection


