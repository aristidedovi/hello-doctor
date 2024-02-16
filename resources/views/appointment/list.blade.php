@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')

<!-- <link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet"> -->

      <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <h4 class="card-title">Liste des rendez-vous</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="button" onclick="window.location='{{ route('appointment.create') }}'" class="btn mb-1 btn-primary pull-right">Nouveau rendez-vous<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                                    </div>
                                </div>
                                
                                <div class="table-responsive"> 
                                    <table id="custom-init" class="table table-hover verticle-middle table-bordered">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col" class="ps-4" style="width: 50px;">
                                                    <div class="form-check font-size-16"><input type="checkbox" class="form-check-input" id="contacusercheck" /><label class="form-check-label" for="contacusercheck"></label></div>
                                                </th> -->
                                                <!-- <th scope="col">ID</th> -->
                                                <th scope="col">Nom Complet</th>
                                                <!-- <th scope="col">adresse</th> -->
                                                <!-- <th scope="col">Téléphone</th> -->
                                                <th scope="col">Date du rendez-vous</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" style="width: 50px;">Actions</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appointment)                                      
                                            <tr>
                                                <td>
                                                    <a href="{{ route('patient.detail', $appointment->patient) }}" 
                                                        data-toggle="tooltip" data-placement="top" title="" data-original-title="Détail"
                                                    >
                                                        {{ $appointment->patient->last_name }}
                                                        {{ $appointment->patient->first_name }}
                                                    </a>
                                                </td>
                                                {{-- <td>
                                                    {{ $appointment->patient->address }}
                                                </td> --}}                                                
                                                <td>
                                                @php
                                                    // Assuming $appointment->date contains the appointment date in the format 'Y-m-d'
                                                    $appointmentDate = $appointment->date;

                                                    // Get the current date
                                                    $currentDate = now()->toDateString();

                                                    // Calculate the difference in days
                                                    $numberOfDays = \Carbon\Carbon::parse($currentDate)->diffInDays($appointmentDate);
                                                @endphp
                                                    <a href="#"
                                                    data-toggle="tooltip" data-placement="top" title="" 
                                                    data-original-title="{{ $numberOfDays != 0 ? 'RDV dans '.$numberOfDays.' jrs' : 'RDV aujourd\'hui' }}"
                                                    >
                                                        {{ ucfirst($appointment->date->formatLocalized('%A %e %B %Y')) }}
                                                        <br>
                                                        <!-- <span>
                                                            Motif : {{ $appointment->motif }}
                                                        </span> -->
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="badge 
                                                        @if($appointment->status === 'en cours')
                                                            badge-success px-2
                                                        @elseif($appointment->status === 'reprogrammer')
                                                            badge-primary px-2
                                                        @else
                                                            badge-danger px-2
                                                        @endif">
                                                        {{ $appointment->status }}
                                                    </span>
                                                </td>
                                                <td style="line-height: unset;">
                                                    <div class="row">
                                                        <div class="col pr-0">
                                                            <a id="myModal" class="btn dropdown-item open-modal-reprogrammer p-0" style="color: black; width: auto;" 
                                                                data-appointment-id="{{ $appointment->id }}"
                                                                data-placement="top" title="Reprogrammer"
                                                                data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
                                                                <i class="fa fa-pencil"></i> 
                                                            </a>
                                                        </div>
                                                        <div class="col pr-0">
                                                        <a id="myModal" class="btn dropdown-item open-modal-cloturer p-0" style="color: green; width: auto;" 
                                                            data-appointment-id="{{ $appointment->id }}"
                                                            data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                                                            @if($appointment->status == 'cloturer') disabled @endif>
                                                            <i class="fa fa-stop-circle"></i> </a>
                                                        </div>
                                                        <div class="col pr-0">
                                                            <!-- <form action="{{ route('appointment.delete', $appointment->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                    <button class="btn dropdown-item p-0" style="color: red; width: auto;" type="submit">
                                                                <i class="fa fa-trash-o"></i></button>
                                                            </form> -->
                                                            <a class="sweet-success-cancel" data-url="{{ route('appointment.delete', $appointment->id) }}" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                                            <i class="fa fa-trash-o" style="color: red;"></i> 
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <span>
                                                        <!-- <a href="{{ route('patient.detail', $appointment->patient) }}">
                                                            <i class="fa fa-eye fa-sm color-muted ml-3 mr-4"></i> 
                                                        </a> -->
                                                        
                                                        <!--<a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close">
                                                            <i class="fa fa-close color-danger mr-3"></i>
                                                        </a> -->
                                                    
                                                    <!-- <div role="group" class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-sm btn-dark dropdown-toggle" type="button" aria-expanded="false"></button>
                                                        <div class="dropdown-menu" style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a href="#" class="btn dropdown-item">Programmer RDV</a> -->
                                                            <!-- <a href="#" class="btn dropdown-item">Edit</a> -->
                                                            <!-- <div class="bootstrap-modal"> -->
                                                            <!-- {{ $numberOfDays != 0 ? 'edisabled' : '' }} -->
                                                                    <!-- <button id="myModal" class="btn dropdown-item open-modal-reprogrammer" style="color: black;" 
                                                                    type="button" data-appointment-id="{{ $appointment->id }}"
                                                                    data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                                                                    >Reprogrammer </button> -->
                                                            <!-- </div> -->
                                                            
                                                            <!-- <div class="bootstrap-modal">
                                                                <button id="myModal" class="btn dropdown-item open-modal-cloturer" style="color: black;" 
                                                                    type="button" data-appointment-id="{{ $appointment->id }}"
                                                                    data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                                                                    @if($appointment->status == 'cloturer') disabled @endif>
                                                                    Cloturer </button>
                                                            </div>                                                             -->
                                                            
                                                            <!-- <form action="{{ route('appointment.delete', $appointment->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <hr class="border-top border-dark mt-0 mb-0">
                                                                <button class="btn dropdown-item" style="color: red;" type="submit">Delete</button>
                                                            </form> -->
                                                            <!-- <a href="{{ route('appointment.delete', $appointment->id) }}" class="btn btn-danger dropdown-item">Delete</a> -->
                                                        <!-- </div>
                                                    </div> -->
                                                    
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Injecter les données par ajax -->
                                                        <!-- <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Reprogrammer le rendez-vous</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"> -->
                                                            <!-- Injecter les données par ajax -->
                                                        <!-- <p>Injected data: 
                                                            {{ $appointment->patient->last_name }}
                                                            {{ $appointment->patient->first_name }}
                                                        </p>
                                                            <form>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                                    <input type="text" class="form-control" id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                                    <textarea class="form-control" id="message-text"></textarea>
                                                                </div>
                                                            </form> -->
                                                        <!-- </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Send message</button>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div> 
                                            @endforeach
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
<script>
        $(document).ready(function () {
            // Add a click event listener to the button
            $('.open-modal-reprogrammer').click(function () {
                // Show loading spinner
                $('#exampleModal .modal-body').html('<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div><p>Loading...</p></div>');

                // Get the data-appointment-id attribute value
                var appointmentId = $(this).data('appointment-id');
                // console.log(appointmentId);

                // Perform any additional actions with the appointmentId if needed
                // Make an AJAX request to fetch the dynamic data
                $.ajax({
                    type: 'GET',
                    url: '/appointment/' + appointmentId + '/get-data',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Update the modal content with the fetched data
                        // console.log(response);
                        $('#exampleModal .modal-content').html(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });

                // Update the modal content with the appointmentId
                // s$('#exampleModal .modal-body').html('<p>Appointment ID: ' + appointmentId + '</p>');
            });

            $('.open-modal-cloturer').click(function () {
                // Show loading spinner
                $('#exampleModal .modal-body').html('<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div><p>Loading...</p></div>');

                // Get the data-appointment-id attribute value
                var appointmentId = $(this).data('appointment-id');
                // console.log(appointmentId);

                // Perform any additional actions with the appointmentId if needed
                // Make an AJAX request to fetch the dynamic data
                $.ajax({
                    type: 'GET',
                    url: '/appointment/' + appointmentId + '/get-data/cloturer',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        // Update the modal content with the fetched data
                        // console.log(response);
                        $('#exampleModal .modal-content').html(response);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });

                // Update the modal content with the appointmentId
                // s$('#exampleModal .modal-body').html('<p>Appointment ID: ' + appointmentId + '</p>');
            });
        });
    </script>


@endpush
@endsection


