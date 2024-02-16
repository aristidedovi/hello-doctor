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
                                                    <span>
                                                        <a href="{{ route('patient.detail', $patient) }}" data-toggle="tooltip" data-placement="top" title="Detail">
                                                            <i class="fa fa-eye color-muted m-r-5 mr-2"></i> 
                                                        </a>
                                                    </span>
                                                    <span class="sweetalert m-t-30">
                                                        <a class="sweet-success-cancel" data-url="{{ route('patient.delete', $patient) }}" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                                            <i class="fa fa-trash-o color-muted m-r-5" style="color: red;"></i> 
                                                        </a>
                                                    </span>
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home8"><span><i class="ti-list"></i></span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile8"><span><i class="ti-calendar"></i></span></a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages8"><span><i class="ti-email"></i></span></a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane fade show active" id="home8" role="tabpanel">
                                        <div class="p-t-1">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        {{-- <div class="row mb-2">
                                                            <div class="col-lg-6">
                                                                <h4 class="card-title">Liste des rendez-vous</h4>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <button type="button" class="btn mb-1 btn-primary pull-right">Nouveau rendez-vous<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                                                            </div>
                                                        </div> --}}
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile8" role="tabpanel">
                                        <div class="p-t-15">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="card-title">
                                                            <h4>Calendar</h4>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 mt-5">
                                                                <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-primary btn-block"><i class="ti-plus f-s-12 m-r-5"></i> Create New</a>
                                                                <div id="external-events" class="m-t-20">
                                                                    <p>Drag and drop your event or click in the calendar</p>
                                                                    <div class="external-event bg-primary text-white" data-class="bg-primary"><i class="fa fa-move"></i>New Theme Release</div>
                                                                    <div class="external-event bg-success text-white" data-class="bg-success"><i class="fa fa-move"></i>My Event</div>
                                                                    <div class="external-event bg-warning text-white" data-class="bg-warning"><i class="fa fa-move"></i>Meet manager</div>
                                                                    <div class="external-event bg-dark text-white" data-class="bg-dark"><i class="fa fa-move"></i>Create New theme</div>
                                                                </div>
                                                                <!-- checkbox -->
                                                                <div class="checkbox m-t-40">
                                                                    <input id="drop-remove" type="checkbox">
                                                                    <label for="drop-remove">Remove after drop</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-box m-b-50">
                                                                    <div id="calendar"></div>
                                                                </div>
                                                            </div>
                        
                                                            <!-- end col -->
                                                            <!-- BEGIN MODAL -->
                                                            <div class="modal fade none-border" id="event-modal">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"><strong>Add New Event</strong></h4>
                                                                        </div>
                                                                        <div class="modal-body"></div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                                                                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal Add Category -->
                                                            <div class="modal fade none-border" id="add-category">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title"><strong>Add a category</strong></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <label class="control-label">Category Name</label>
                                                                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <label class="control-label">Choose Category Color</label>
                                                                                        <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                                                            <option value="success">Success</option>
                                                                                            <option value="danger">Danger</option>
                                                                                            <option value="info">Info</option>
                                                                                            <option value="pink">Pink</option>
                                                                                            <option value="primary">Primary</option>
                                                                                            <option value="warning">Warning</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- END MODAL -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /# card -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="messages8" role="tabpanel">
                                        <div class="p-t-15">
                                            <h4>This is icon title</h4>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                                        </div>
                                    </div>
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


