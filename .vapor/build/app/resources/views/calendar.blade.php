@extends('layouts/main')

@section('title', 'Home Page')

@section('content')


        <!--**********************************
            Content body start
        ***********************************-->
        @php
            $appointmentsArray = $allAppointments->map(function ($appointment) {
                $appointment->load('patient');

                return [
                    'id' => $appointment->id,
                    'motif' => $appointment->motif,
                    'date' => $appointment->date,
                    'status' => $appointment->status,
                    'patient' => [
                        'id' => $appointment->patient->id,
                        'first_name' => $appointment->patient->first_name,
                    ],
                ];
            });
        
            $jsonAppointments = json_encode($appointmentsArray);
        @endphp
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="card-box m-b-50">
                                        <div id="calendar"></div>
                                    </div>
                                </div>

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
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    @push('scripts')
        <script src="{{ asset('plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/fr.js"></script>
        
        <script>
            var appointments = {!! $jsonAppointments !!};
            console.log(appointments);
           

            var t = new Date,
            n = (t.getDate(), t.getMonth(), t.getFullYear(), new Date()),
            // appointmentCalendar = appointments
             tabCalendrier = [];

            for (var i = 0; i < appointments.length; i++) {
                var objCalendrier = new Object();

                objCalendrier.title = appointments[i].patient.first_name;
                objCalendrier.start = appointments[i].date;
                objCalendrier.end = appointments[i].date;
                objCalendrier.className = "bg-primary";
                //objCalendrier.color = "red";
                objCalendrier.textColor = "white";

                tabCalendrier.push(objCalendrier);
            }


            //console.log(tabCalendrier);

            // rdvCalendrier = [{
            //     title: "Dovi!",
            //     start: new Date(),
            //     className: "bg-dark"
            // }, {
            //     title: "See John Deo",
            //     start: n,
            //     end: n,
            //     className: "bg-danger"
            // }, {
            //     title: "Buy a Theme",
            //     start: new Date(),
            //     className: "bg-primary"
            // }];


            
            //var rdvC = JSON.parse(rdvCalendrier);

                 // console.log("calendrier",rdvCalendrier);
                  //console.log("calendrier parser",rdvC);
            //var tabCalendrier = [];

                //   for(var i = 0; i < rdvC.length; i++){
                //       var objCalendrier = new Object();
                //       objCalendrier.title = rdvC[i].nomComplet;

                //       var datereel = new Date(rdvC[i].heureR);
                //       var datefin = new Date(datereel);
                //       datefin = new Date(datefin.setMinutes(datefin.getMinutes()+30)),

                //       objCalendrier.start = datereel ;
                //       objCalendrier.end = datefin ;

                //       if(rdvC[i].id_etat_rendez_vous == 1){
                //           objCalendrier.className = 'bg-succes';
                //       }else if(rdvC[i].id_etat_rendez_vous == 2){
                //           objCalendrier.className = 'bg-primary';
                //       }else if(rdvC[i].id_etat_rendez_vous == 3){
                //           objCalendrier.className = 'bg-danger';
                //       }

                //       tabCalendrier.push(objCalendrier);

                //   }
                   //console.log("nouveau Tableau", tabCalendrier);
                   //console.log("heure", rdvC[i].heureR);
                   // ...
            
        </script>
        <script src="{{ asset('js/plugins-init/fullcalendar-init.js') }}"></script>
    @endpush

@endsection
