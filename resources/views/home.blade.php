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
                        <div class="card h-100">
                            <div class="card-body" style="padding: 1.25rem;">
                                <h4 class="card-title">Les rendez-vous du jour</h4>
                                <form id="search-form-appointment">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="text" id="search-query-appointment" class="form-control" placeholder="Recherche de patient">
                                        </div>
                                        <!-- <div class="form-group col-md-4">
                                            <select id="filter-appointments" class="form-control">
                                                <option value="all">All Appointments</option>
                                                <option value="today" selected>Today's Appointments</option>
                                            </select>
                                        </div> -->
                                    </div>
                                        <!-- <button type="submit" class="btn btn-primary">Search</button> -->
                                    </form>
                                <div id="appointment-content">
                                    @include('appointment.partials.appointment')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                            <div class="card card-widget h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Liste de patient </h5>
                                    <form id="search-form">
                                        <div class="form-group">
                                            <input type="text" id="search-query" class="form-control" placeholder="Recherche de patient">
                                        </div>
                                        <!-- <button type="submit" class="btn btn-primary">Search</button> -->
                                    </form>
                                    <div id="patient-content">
                                        @include('patient.partials.patients')
                                    </div>
                                    <!-- <h2 class="mt-4">5680</h2>
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
                                    </div> -->
                                    <!-- <div class="mt-4">
                                        <h4>20</h4>
                                        <h6 class="m-t-10 text-muted">Cash On Develery <span class="pull-right">20%</span></h6>
                                        <div class="progress mb-3" style="height: 7px">
                                            <div class="progress-bar bg-warning" style="width: 20%;" role="progressbar"><span class="sr-only">20% Order</span>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            
                        </div>
                        <!-- <div class="col-lg-3 col-md-6">
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
                        </div> -->
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

@push('scripts')
<script>
                                    $(document).ready(function () {
                                        $(document).on('click', '.pagination a', function (event) {
                                            event.preventDefault();
                                            var url = $(this).attr('href');
                                            console.log(url);
                                            fetch_data(url);
                                        });

                                        $('#search-form').on('input', function (event) {
                                            event.preventDefault();
                                            var query = $('#search-query').val();
                                            if (query.length > 0) {
                                                fetch_data("{{ route('dashboard') }}?search_query=" + query);
                                            } else {
                                                // Si le champ de recherche est vide, charger les données par défaut
                                                fetch_data("{{ route('dashboard') }}?search_query=");
                                            }
                                            //fetch_data("{{ route('dashboard') }}?search_query=" + query);
                                        });

                                        // Filtrer les rendez-vous
                                        $('#filter-appointments').on('change', function () {
                                            var filter = $(this).val();
                                            //console.log(filter);
                                            //var query = $('#search-query').val();
                                            // fetch_data("{{ route('dashboard') }}?filter=" + filter + "&search_query=" + query);
                                            fetch_data("{{ route('dashboard') }}?filter=" + filter);
                                        });


                                        $('#search-form-appointment').on('input', function (event) {
                                            event.preventDefault();
                                            var query = $('#search-query-appointment').val();
                                            //console.log(query.length);
                                            if (query.length > 0) {
                                                fetch_data("{{ route('dashboard') }}?search_query_appointment=" + query);
                                            } else {
                                                // Si le champ de recherche est vide, charger les données par défaut
                                                fetch_data("{{ route('dashboard') }}?search_query_appointment=");
                                            }
                                            //fetch_data("{{ route('dashboard') }}?search_query_appointment=" + query);
                                        });

                                        function fetch_data(url) {
                                            $.ajax({
                                                //url: "/?patient_page=" + page,
                                                url: url,
                                                success: function (data) {
                                                    //console.log(data);
                                                    if (url.includes('appointment_page') || url.includes('search_query_appointment') || url.includes('filter')) {
                                                        //console.log(data);
                                                        $('#appointment-content').html(data);
                                                    } else if (url.includes('patient_page') || url.includes('search_query')) {
                                                        $('#patient-content').html(data);
                                                    }
                                                    //console.log(data);
                                                    //$('#patient-content').html(data);
                                                },
                                                error: function (xhr, status, error) {
                                                    console.log(xhr.responseText);
                                                }
                                            });
                                        }
                                    });
                                </script>
@endpush


@endsection

