@extends('layouts/main')

@section('title', 'Home Page')

@section('content')





    
    <!--**********************************
        Main wrapper start
    ***********************************-->


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">RDV du jour</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $todayAppointments->count() }}</h2>
                                    <p class="text-white mb-0">{{ now()->locale('fr')->formatLocalized('%A %e %B %Y') }}</p>
                                </div>
                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">RVD du mois</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $currentMonthAppointments->count() }}</h2>
                                    <p class="text-white mb-0">{{ now()->locale('fr')->formatLocalized('%B %Y') }}</p>
                                </div>
                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total RDV</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $allAppointments->count() }}</h2>
                                    <p class="text-white mb-0">Toutes les rendez-vous</p>
                                </div>
                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-4">
                            <div class="card-body">
                                <h3 class="card-title text-white">Total patient</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white">{{ $allpatients->count() }}</h2>
                                    <p class="text-white mb-0">Nombre total des patients</p>
                                </div>
                                <!-- <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-6 col-xxl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Les rendez-vous du jour</h4>
                                <div id="activity">
                                    @if($todayAppointmentsPaginate->count() > 0)
                                        @foreach ($todayAppointmentsPaginate as $appointment)
                                            <div class="media border-bottom-1 pt-3 pb-3">
                                                <img width="35" src="./images/avatar/1.jpg" class="mr-3 rounded-circle">
                                                <div class="media-body">
                                                    <h5>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</h5>
                                                    <p class="mb-0">{{ $appointment->date->locale('fr')->formatLocalized('%A %e %B %Y') }}</p>
                                                    <p class="mb-0">Motif : {{ $appointment->motif }}</p>
                                                    <a href="{{ route('patient.detail', $appointment->patient) }}" data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <i class="fa fa-eye color-muted m-r-5"></i> Détail
                                                    </a>
                                                </div>
                                                <!-- <span class="text-muted ">{{ $appointment->date->locale('fr')->formatLocalized('%A %e %B %Y') }}</span> -->
                                                <span class="badge
                                                        @if($appointment->status === 'confirmed')
                                                            badge-success px-2
                                                        @elseif($appointment->status === 'pending')
                                                            badge-primary px-2
                                                        @else
                                                            badge-danger px-2
                                                        @endif">
                                                        {{ $appointment->status }}
                                                </span>
                                            </div>
                                            @php
                                                if($loop->iteration >= 3) {
                                                    break;
                                                }
                                            @endphp
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Afficher la pagination -->
                                                {{ $todayAppointmentsPaginate->links('partials.pagination') }}
                                            </div>
                                        </div>
                                        @else
                                            {{-- Display content if there are no appointments for the current month --}}
                                            <p>No appointments found for the current day.</p>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                            <div class="card card-widget">
                                <div class="card-body">
                                    <h5 class="text-muted">Order Overview </h5>
                                    <h2 class="mt-4">5680</h2>
                                    <span>Total Revenue</span>
                                    <div class="mt-4">
                                        <h4>30</h4>
                                        <h6>Online Order <span class="pull-right">30%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-primary" style="width: 30%;" role="progressbar"><span class="sr-only">30% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h4>50</h4>
                                        <h6 class="m-t-10 text-muted">Offline Order <span class="pull-right">50%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-success" style="width: 50%;" role="progressbar"><span class="sr-only">50% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h4>20</h4>
                                        <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">20%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-warning" style="width: 20%;" role="progressbar"><span class="sr-only">20% Order</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="card-body px-0">
                                    <h4 class="card-title px-4 mb-3">Todo</h4>
                                    <div class="todo-list">
                                        <div class="tdl-holder">
                                            <div class="tdl-content">
                                                <ul id="todo_list">
                                                    <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#' class="ti-trash"></a></label></li>
                                                    <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a href='#' class="ti-trash"></a></label></li>
                                                    <li><label><input type="checkbox"><i></i><span>Don't give up the fight.</span><a href='#' class="ti-trash"></a></label></li>
                                                    <li><label><input type="checkbox" checked><i></i><span>Do something else</span><a href='#' class="ti-trash"></a></label></li>
                                                </ul>
                                            </div>
                                            <div class="px-4">
                                                <input type="text" class="tdl-new form-control" placeholder="Write new item and hit 'Enter'...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

@endsection
