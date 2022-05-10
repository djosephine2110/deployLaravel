<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Erakomp Project Management</title>
    <link href="{{ URL::asset('css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/jquery.atwho.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/fonts/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/bootstrap-tour-standalone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/picker.classic.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/vis-timeline@7.3.4/styles/vis-timeline-graph2d.min.css" />
    <link rel="stylesheet" href="{{ asset(elixir('css/vendor.css')) }}" />
    <link rel="stylesheet" href="{{ asset(elixir('css/app.css')) }}" />
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" href="https://cdn.erakomp.co.id/assets/Icon%20logo%20kanban%20board-01.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="{{ asset(elixir('css/bootstrap-select.min.css')) }}" />
    <link href="{{ URL::asset('css/summernote.css') }}" rel="stylesheet" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap");
        body {
            background: #7f7fd5;
            /* fallback for old browsers */
            background: -webkit-linear-gradient( to right, #91eae4, #86a8e7, #7f7fd5);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #91eae4, #86a8e7, #7f7fd5);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            font-family: "Baloo 2", cursive;
            font-size: 16px;
        }
        
        .tablet__body.tablet__tigthen p img {
            max-width: 300px !important;
        }
    </style>
    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        
        #myImg:hover {
            opacity: 0.7;
        }
        /* The Modal (background) */
        
        .modals {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: transparent;
            /* Black w/ opacity */
        }
        /* Modal Content (image) */
        
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 500px;
        }
        /* Caption of Modal Image */
        
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }
        /* Add Animation */
        
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }
        
        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0);
            }
            to {
                -webkit-transform: scale(1);
            }
        }
        
        @keyframes zoom {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }
        /* The Close Button */
        
        .closes {
            position: absolute;
            margin-right: 50%;
            top: 10%;
            right: -18%;
            color: #000;
            font-size: 40px;
            font-weight: bold;
            text-decoration: none;
        }
        
        .closes:hover,
        .closes::after {
            color: rgb(255, 0, 0);
            text-decoration: none;
            cursor: pointer;
        }
        /* 100% Image Width on Smaller Screens */
        
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <style>
        .dropbtn {
            background-color: #4caf50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        
        .spann:before {
            position: absolute;
            left: -20px;
            top: 0;
            content: "";
            background-color: green;
            border-radius: 5px;
            font-size: 0;
            padding: 5px;
        }
        
        .spann:after {
            position: absolute;
            left: 20px;
            top: 0;
            content: "";
            background-color: grey;
            border-radius: 5px;
            font-size: 0;
            padding: 5px;
        }
        
        #text {
            max-width: 100px !important;
        }
        
        .small-box h3 {
            white-space: nowrap !important;
        }
    </style>

    <?php if(isDemo()) { ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152899919-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "UA-152899919-3");
    </script>
    <?php } ?>
    <script src="https://js.stripe.com/v3/"></script>
    @stack('style')
</head>

<body>
    <div id="wrapper">
        @include('layouts._navbar')
        <!-- /#sidebar-wrapper -->
        <!-- Sidebar menu -->

        <nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm" role="navigation" style="font-size: 21px !important">
            <div class="list-group panel">
                @if(Auth::user()->image != NULL)
                <p class="list-group-item siderbar-top" title="">
                    <img src="{{Auth::user()->image}}" alt="" style="
                width: 70%;
                margin: 1em 0;
                margin-left: 15%;
                border-radius: 100px;
              " class="img-rounded" />
                </p>
                @elseif(Auth::user()->image == NULL)
                <p class="list-group-item siderbar-top" title="">
                    <img src="https://www.baytekent.com/wp-content/uploads/2016/12/facebook-default-no-profile-pic1.jpg" alt="" style="
                width: 70%;
                margin: 1em 0;
                margin-left: 15%;
                border-radius: 100px;
              " class="img-rounded" />
                </p>
                @endif
                <a href="#" class="list-group-item" data-parent="#MainMenu" disabled="disabled" style="pointer-events: none !important; text-align: center"><span
              id="menu-txt"
              style="
                font-size: 16px !important;
                font-size: 21px !important;
                color: white;
                font-weight: 400;
              "
            >
              Hi, {{Auth::user()->name}}
            </span></a
          >
          <a href="/dass" class="list-group-item" data-parent="#MainMenu"
            ><i class="fas fa-chart-line sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important"
              >Dashboard
            </span></a
          >
          <a href="/searching" class="list-group-item" data-parent="#MainMenu"
            ><i class="fas fa-search sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important"
              >Find Tasks
            </span></a
          >

          <a href="/userr" class="list-group-item" data-parent="#MainMenu"
            ><i class="fas fa-user-edit sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important"
              >Edit Profile</span
            ></a
          >
          {{--
          <a href="/labels" class="list-group-item" data-parent="#MainMenu"
            ><i class="fas fa-tags sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important"
              >Tags
            </span></a
          >
          --}} @if(Entrust::hasRole('owner'))

          <a href="/colors" class="list-group-item" data-parent="#MainMenu"
            ><i class="fas fa-list sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important"
              >List
            </span></a
          >
          @endif
          <a
            href="#projects"
            class="list-group-item"
            data-toggle="collapse"
            data-parent="#MainMenu"
            ><i class="fa fa-briefcase sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important">{{
              __("Projects")
            }}</span>
            <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i
          ></a>
                <div class="collapse" id="projects">
                    <a href="{{ route('projects.index') }}" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> {{ __("All Projects") }}</a>
                    @if(Entrust::can('project-create'))
                    <a href="{{ route('projects.create') }}" id="newProject" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> {{ __("New Project") }}</a>
                    @endif
                </div>
                <!-- <a href="#tasks" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                        class="fa fa-tasks sidebar-icon "></i><span id="menu-txt">{{ __('Tasks') }}</span>
                <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i></a>
            <div class="collapse" id="tasks">
                <a href="{{ route('tasks.index')}}" class="list-group-item childlist"> <i
                            class="bullet-point"><span></span></i> {{ __('All Tasks') }}</a>
                @if(Entrust::can('task-create'))
                    <a href="{{ route('tasks.create')}}" id="newTask" class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('New Task') }}</a>
                @endif
            </div>-->

                <a href="#user" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-users sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important">{{
              __("Users")
            }}</span>
            <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i
          ></a>
                <div class="collapse" id="user">
                    <a href="/users" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> {{ __("All Users") }}</a>
                    @if(Entrust::can('user-create'))
                    <a href="{{ route('productss.create') }}" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> {{ __("New User") }}
                    </a>
                    <a href="/pegawa" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> Register Roles
                    </a>
                    <a href="{{ route('roles.index') }}" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> {{ __("Role & Permissions Management") }}</a>
                    <a href="/div" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> Add Division
                    </a>
                    @endif
                </div>

                <!--<a href="#leads" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                        class="fa fa-hourglass-2 sidebar-icon"></i><span id="menu-txt">{{ __('Leads') }}</span>
                <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i></a>
            <div class="collapse" id="leads">
            <a href="{{ route('leads.index')}}" class="list-group-item childlist"> <i
                            class="bullet-point"><span></span></i> {{ __('All Leads') }}</a>
                @if(Entrust::can('lead-create'))
                    <a href="{{ route('leads.create')}}"
                       class="list-group-item childlist"> <i class="bullet-point"><span></span></i> {{ __('New Lead') }}
                    </a>
                @endif
            </div>-->
                <!--<a href="#sales" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                class="fa fa-dollar sidebar-icon"></i><span id="menu-txt">{{ __('Sales') }}</span>
                <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i></a>
            <div class="collapse" id="sales">
            <a href="{{ route('invoices.overdue')}}" class="list-group-item childlist"> 
                <i class="bullet-point"><span></span></i> {{ __('Overdue') }}
            </a>
            <a href="{{ route('products.index')}}" class="list-group-item childlist"> 
                <i class="bullet-point"><span></span></i> {{ __('Products') }}
            </a>
            </div>
            @if(Entrust::can('calendar-view'))
                <a href="#appointments" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                            class="fa fa-calendar sidebar-icon"></i><span id="menu-txt">{{ __('Appointments') }}</span>
                    <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i></a>
                <div class="collapse" id="appointments">
                    <a href="{{ route('appointments.calendar')}}" target="_blank"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Calendar') }}</a>
                </div>
            @endif-->
                <!-- <a href="#hr" class=" list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i
                        class="fa fa-handshake-o sidebar-icon"></i><span id="menu-txt">{{ __('HR') }}</span>
                <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i></a>-->
                <!--<div class="collapse" id="hr">
                @if(Entrust::can('absence-view'))
                    <a href="{{ route('absence.index')}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Absence overview') }}</a>
                @endif
                @if(Entrust::can('absence-manage'))
                    <a href="{{ route('absence.create', ['management' => 'true'])}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Register absence') }}</a>
                @endif
                <a href="{{ route('departments.index')}}"
                   class="list-group-item childlist"> <i
                            class="bullet-point"><span></span></i> {{ __('Departments') }}</a>
            </div>
        -->

                <a href="#settings" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu" style="font-size: 16px !important"><i class="fa fa-cog sidebar-icon"></i
            ><span id="menu-txt">Report</span>
            <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i
          ></a>
                <div class="collapse" id="settings">
                    <!-- <a href="{{ route('settings.index')}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Overall Settings') }}</a>
                   -->

                    <a href="/digitalrepem" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Digital Report</a>
                    <a href="/report" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Excel Report</a>
                    @if(Auth::user()->user_flag == 2)
                    <a href="/testsup" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get QC & Done KPI Report
                    </a>
                    @else
                    <a href="/test" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get QC & Done KPI Report
                    </a>
                    @endif @if(Auth::user()->user_flag == 2)
                    <a href="/overduesup" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Deadline Tasks Report
                    </a>
                    @else

                    <a href="/overdue" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Deadline Tasks Report
                    </a>
                    @endif @if(Auth::user()->user_flag == 2)
                    <a href="/menusssup" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Duration Progressing-Done
                    </a>
                    @else
                    <a href="/menuss" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Duration Progressing-Done
                    </a>
                    @endif
                    <!--<a href="{{ route('integrations.index')}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Integrations') }}</a>-->
                </div>

                @if(Entrust::hasRole('owner'))
                <!--<a href="/report" class=" list-group-item" data-parent="#MainMenu" style="font-size: 16px!important;"><i class="fa fa-file sidebar-icon" aria-hidden="true"></i>
                <span id="menu-txt" >Report</span></a>-->
                <div class="collapse" id="settings">
                    <!-- <a href="{{ route('settings.index')}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Overall Settings') }}</a>
                   -->
                    <a href="{{ route('roles.index') }}" class="list-group-item childlist" style="font-size: 16px !important">
                        <i class="bullet-point"><span></span></i> {{ __("Role & Permissions Management") }}</a>
                    <!--<a href="{{ route('integrations.index')}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Integrations') }}</a>-->
                </div>
                @endif @if(Entrust::hasRole('owner'))
                <div class="collapse" id="settings">
                    <!-- <a href="{{ route('settings.index')}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Overall Settings') }}</a>
                   -->
                    <a href="{{ route('roles.index') }}" class="list-group-item childlist">
                        <i class="bullet-point"><span></span></i> {{ __("Role & Permissions Management") }}</a>
                    <!--<a href="{{ route('integrations.index')}}"
                       class="list-group-item childlist"> <i
                                class="bullet-point"><span></span></i> {{ __('Integrations') }}</a>-->
                </div>
                @endif
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="global-heading">@yield('heading')</h1>
                        @yield('content')
                    </div>
                </div>
            </div>
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>

            @endif @if(Session::has('flash_message_warning'))

            <message message="{{ Session::get('flash_message_warning') }}" type="warning"></message>
            @endif @if(Session::has('flash_message'))
            <message message="{{ Session::get('flash_message') }}" type="success"></message>
            @endif
        </div>

        <!-- /#page-content-wrapper -->
    </div>
    <script src="{{ URL::asset('js/manifest.js') }}"></script>
    <script src="{{ URL::asset('js/vendor.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dropzone.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jasny-bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.caret.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.atwho.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-ui-sortable.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-tour-standalone.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/picker.js') }}"></script>

    @if(App::getLocale() == "dk")
    <script>
        $(document).ready(function() {
            $.extend($.fn.pickadate.defaults, {
                monthsFull: [
                    "januar",
                    "februar",
                    "marts",
                    "april",
                    "maj",
                    "juni",
                    "juli",
                    "august",
                    "september",
                    "oktober",
                    "november",
                    "december",
                ],
                monthsShort: [
                    "jan",
                    "feb",
                    "mar",
                    "apr",
                    "maj",
                    "jun",
                    "jul",
                    "aug",
                    "sep",
                    "okt",
                    "nov",
                    "dec",
                ],
                weekdaysFull: [
                    "søndag",
                    "mandag",
                    "tirsdag",
                    "onsdag",
                    "torsdag",
                    "fredag",
                    "lørdag",
                ],
                weekdaysShort: ["søn", "man", "tir", "ons", "tor", "fre", "lør"],
                today: "i dag",
                clear: "slet",
                close: "luk",
                firstDay: 1,
                format: "d. mmmm yyyy",
                formatSubmit: "yyyy/mm/dd",
            });
        });
    </script>
    @endif @stack('scripts')
    <script>
        window.trans = <?php
      // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
      try {
          $filename = File::get(resource_path() . '/lang/' . App::getLocale() . '.json');
      } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
          return;
      }
      $trans = [];
      $entries = json_decode($filename, true);
      foreach ($entries as $k => $v) {
          $trans[$k] = trans($v);
      }
      $trans[$filename] = trans($filename);
      echo json_encode($trans);
      ?>;
    </script>
</body>

</html>