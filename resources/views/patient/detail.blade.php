@extends('layouts/main')

@section('title', 'Rendez-vous')


@section('content')

      <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
            <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="{{asset('images/avatar/patient.png')}}" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0">{{ $patient->first_name }} {{ $patient->last_name }}</h3>
                                        <p class="text-muted mb-0">{{ $patient->code }}</p>
                                    </div>
                                </div>
                                
                                <!-- <div class="row mb-5">
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                            <h3 class="mb-0">263</h3>
                                            <p class="text-muted px-4">Following</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-warning"><i class="icon-user-follow"></i></span>
                                            <h3 class="mb-0">263</h3>
                                            <p class="text-muted">Followers</p>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-danger px-5">Follow Now</button>
                                    </div>
                                </div> -->

                                <h4>Adresse</h4>
                                <p class="text-muted">{{ $patient->address }}</p>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Phone</strong> <span>{{ $patient->phone }}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Age &nbsp;&nbsp;&nbsp;</strong> <span>{{ $patient->age }} ans</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Genre</strong> <span>{{ $patient->genre }}</span></li>
                                </ul>
                            </div>
                        </div>  
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h4 class="card-title">
                                            Historique des rendez-vous 
                                            @if($appointment !== null)
                                                <span class="badge badge-secondary">{{$appointment->status}}</span>
                                            @endif
                                        </h4>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">                                        
                                        <button type="button" id="myModal" 
                                            class="btn mb-1 btn-primary pull-right open-modal-reprogrammer mr-2 btn-xs"
                                            data-placement="top" title="Reprogrammer"
                                            @if($appointment !== null)
                                                data-appointment-id="{{ $appointment->id }}"
                                            @endif
                                            data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                                            @if($appointment !== null && $appointment->status == 'cloturer') disabled @endif>
                                            <i class="fa fa-pencil"></i>   
                                        </button>

                                        <button type="button" id="myModal" 
                                            class="btn mb-1 btn-danger pull-right open-modal-cloturer btn-xs" 
                                            @if($appointment !== null)
                                                data-appointment-id="{{ $appointment->id }}"
                                            @endif
                                            data-placement="top" title="Cloturer"
                                            data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"
                                            @if($appointment !== null && $appointment->status == 'cloturer') disabled @endif>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="email-list m-t-15">
                                @if($appointment !== null)
                                    @foreach ($appointment->motifs as $motif)
                                    <div class="message">
                                            <a href="#">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="subject">
                                                            <i class="fa fa-comments-o mr-3" ></i>
                                                            {{ $motif->motif }}
                                                        </div>
                                                    </div>
                                                    <div class="col-4 d-flex justify-content-end">
                                                        @php
                                                            $timestamp = strtotime($motif->date);
                                                        @endphp
                                                        <div style="padding-left: 0px" class="date">{{ strftime('%A %e %B %Y', $timestamp) }}</div>
                                                        </div>
                                                </div>
                                                <!-- <div class="col-mail col-mail-1"> -->
                                                    <!-- <div class="email-checkbox">
                                                        <input type="checkbox" id="chk2">
                                                        <label class="toggle" for="chk2"></label>
                                                    </div> -->
                                                    <!-- <span class="star-toggle ti-star"></span> -->
                                                <!-- </div> -->
                                                <!-- <div class="col-mail col-mail-2">
                                                    <div class="subject">{{ $motif->motif }}</div>
                                                    @php
                                                        $timestamp = strtotime($motif->date);
                                                    @endphp
                                                    <div style="padding-left: 0px" class="date">{{ strftime('%A %e %B %Y', $timestamp) }}</div>
                                                </div> -->
                                            </a>
                                        </div>
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
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@push('scripts')
<script>
        $(document).ready(function () {
            // Add a click event listener to the button
            $('.open-modal-reprogrammer').click(function () {
                //alert('click');
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
