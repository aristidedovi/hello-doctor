<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    {{-- <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title> --}}
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <!-- Pignose Calender -->
    {{-- <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet"> --}}
    <!-- Chartist -->
    {{-- <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet --> --}}
    <!-- Custom Stylesheet -->
    <!-- Custom Stylesheet -->
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    
    <link href="{{ asset('plugins/fullcalendar/css/fullcalendar.min.css') }}" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="{{ asset('plugins/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="{{ asset('plugins/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/sweetalert/css/sweetalert.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        /* Your custom styles here */
        .toast-success {
            background-color: #4CAF50;
            color: white;
        }

        .toast-error {
            background-color: #f44336;
            color: white;
        }
    </style>
    @stack('styles')

</head>

<body>

    {{-- <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************--> --}}
   
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="{{ asset('images/logo.png') }}" alt=""> </b>
                    <span class="logo-compact"><img src="{{ asset('images/logo-compact.png') }}" alt=""></span>
                    <span class="brand-title">
                        <img src="{{ asset('images/logo-text.png') }}" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <!-- <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                            <span>{{ Auth::user()->name }}</span> <!-- <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i> -->
                            </a>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('images/user/1.png') }}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <!-- <li>
                                            <a href="javascript:void()">
                                                <i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li> -->
                                        
                                        <hr class="my-2">
                                        <!-- <li>
                                            <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li> -->
                                        <li><a href="{{ route('logout') }}"><i class="icon-key"></i> <span>Logout</span></a></li>
                                        <!-- <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-responsive-nav-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                    <i class="icon-key"></i>
                                                    <span>{{ __('Log Out') }}</span>
                                                </x-responsive-nav-link>
                                            </form>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="/">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                        {{--{{href="javascript:void()"}}  <ul aria-expanded="false">
                            <li><a href="./index.html">Home 1</a></li>
                            <!-- <li><a href="./index-2.html">Home 2</a></li> -->
                        </ul> --}}
                    </li>
                    <li>
                        <a href="{{ route('calendar') }}">
                            <i class="fa fa-calendar"></i><span class="nav-text">Calendar</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i> <span class="nav-text">Rendez vous</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('appointment.create') }}">Nouveau RDV</a></li>
                            <li><a href="{{ route('appointment.index') }}">Liste RDV</a></li>
                            <li><a href="{{ route('appointment.archive') }}">Archive RDV</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-file"></i> <span class="nav-text">Documents</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('invoices.create') }}">Nouveau Document</a></li>
                            <li><a href="{{ route('invoices') }}">Liste documents</a></li>
                            <li><a href="{{ route('items.index') }}">Les soins</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i> <span class="nav-text">Patients</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('patient.create') }}">Nouveau patient</a></li>
                            <li><a href="{{ route('patient.index') }}">Liste patient</a></li>
                        </ul>
                    </li>
                    {{-- <li class="mega-menu mega-menu-sm {{ (request()->is('appointment/*')) ? 'active' : '' }}">
                        <a href="{{ route('appointment.index') }}">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Rendez vous</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-label">Apps</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Email</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./email-inbox.html">Inbox</a></li>
                            <li><a href="./email-read.html">Read</a></li>
                            <li><a href="./email-compose.html">Compose</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Apps</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.html">Profile</a></li>
                            <li><a href="./app-calender.html">Calender</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-graph menu-icon"></i> <span class="nav-text">Charts</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./chart-flot.html">Flot</a></li>
                            <li><a href="./chart-morris.html">Morris</a></li>
                            <li><a href="./chart-chartjs.html">Chartjs</a></li>
                            <li><a href="./chart-chartist.html">Chartist</a></li>
                            <li><a href="./chart-sparkline.html">Sparkline</a></li>
                            <li><a href="./chart-peity.html">Peity</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="nav-label">UI Components</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-grid menu-icon"></i><span class="nav-text">UI Components</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.html">Accordion</a></li>
                            <li><a href="./ui-alert.html">Alert</a></li>
                            <li><a href="./ui-badge.html">Badge</a></li>
                            <li><a href="./ui-button.html">Button</a></li>
                            <li><a href="./ui-button-group.html">Button Group</a></li>
                            <li><a href="./ui-cards.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-list-group.html">List Group</a></li>
                            <li><a href="./ui-media-object.html">Media Object</a></li>
                            <li><a href="./ui-modal.html">Modal</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                        <!-- </ul> --}}
                    {{-- </li> --}}
                    {{-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-layers menu-icon"></i><span class="nav-text">Components</span>
                        </a>
                        <ul aria-expanded="false"> -->
                            <li><a href="./uc-nestedable.html">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.html">Toastr</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li>
                        <a href="widgets.html" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Widget</span>
                        </a>
                    </li>
                    <li class="nav-label">Forms</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-note menu-icon"></i><span class="nav-text">Forms</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./form-basic.html">Basic Form</a></li>
                            <li><a href="./form-validation.html">Form Validation</a></li>
                            <li><a href="./form-step.html">Step Form</a></li>
                            <li><a href="./form-editor.html">Editor</a></li>
                            <li><a href="./form-picker.html">Picker</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="nav-label">Table</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-menu menu-icon"></i><span class="nav-text">Table</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./table-basic.html" aria-expanded="false">Basic Table</a></li>
                            <li><a href="./table-datatable.html" aria-expanded="false">Data Table</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li class="nav-label">Pages</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i><span class="nav-text">Pages</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./page-login.html">Login</a></li>
                            <li><a href="./page-register.html">Register</a></li>
                            <li><a href="./page-lock.html">Lock Screen</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="./page-error-404.html">Error 404</a></li>
                                    <li><a href="./page-error-403.html">Error 403</a></li>
                                    <li><a href="./page-error-400.html">Error 400</a></li>
                                    <li><a href="./page-error-500.html">Error 500</a></li>
                                    <li><a href="./page-error-503.html">Error 503</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        
        @yield('content')


    </div>
    
    {{-- @include('partials.footer') --}}

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/gleek.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>

    <script src="{{ asset('plugins/jqueryui/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    
    <!-- Clock Plugin JavaScript -->
    <script src="{{ asset('plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>

    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('js/plugins-init/form-pickers-init.js') }}"></script>

    <script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>

    

    <script src="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.js"></script>

    @if (session('toast'))
        <script>
            var toastData = @json(session('toast'));

            // Display a toast message
            Toastify({
                text: toastData.message,
                duration: 3000,  // Adjust as needed
                close: true,
                gravity: "top", // Or "top", "bottom", "left", "right"
                position: 'right',  // Or 'center'
                className: `toast-${toastData.type}`,
            }).showToast();
        </script>
        
    @endif
    
    @stack('scripts')

    <!-- Chartjs -->
    {{-- <script src="./plugins/chart.js/Chart.bundle.min.js"></script> --}}
    <!-- Circle progress -->
    {{-- <script src="./plugins/circle-progress/circle-progress.min.js"></script> --}}
    <!-- Datamap -->
    {{-- <script src="./plugins/d3v3/index.js"></script>
    <script src="./plugins/topojson/topojson.min.js"></script>
    <script src="./plugins/datamaps/datamaps.world.min.js"></script> --}}
    <!-- Morrisjs -->
    {{-- <script src="./plugins/raphael/raphael.min.js"></script>
    <script src="./plugins/morris/morris.min.js"></script> --}}
    <!-- Pignose Calender -->
    {{-- <script src="./plugins/moment/moment.min.js"></script>
    <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script> --}}
    <!-- ChartistJS -->
    {{-- <script src="./plugins/chartist/js/chartist.min.js"></script>
    <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script> --}}



    {{-- <script src="./js/dashboard/dashboard-1.js"></script> --}}
</body>
</html>
