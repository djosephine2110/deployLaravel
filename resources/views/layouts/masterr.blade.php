<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Erakomp Project Management</title>
    <link href="{{ URL::asset('css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
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
            background: -webkit-linear-gradient( to right, #91eae4, #86a8e7, #7f7fd5);
            background: linear-gradient(to right, #91eae4, #86a8e7, #7f7fd5);
            font-family: "Baloo 2", cursive;
            font-size: 16px;
        }
        
        .tablet__body.tablet__tigthen p img {
            max-width: 300px !important;
        }
    </style>
    <script src="https://js.stripe.com/v3/"></script>
    @stack('style')
</head>

<body>
    <div id="wrapper">
        @include('layouts.navie')
        <nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm" role="navigation" style="font-size: 21px !important">
            <div class="list-group panel">
                @if (Auth::user()->image != null)
                <p class="list-group-item siderbar-top" title="">
                    <img src="{{ Auth::user()->image }}" alt="" style="
                width: 70%;
                margin: 1em 0;
                margin-left: 15%;
                border-radius: 100px;
              " class="img-rounded" />
                </p>
                @elseif(Auth::user()->image == null)
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
              Hi, {{ Auth::user()->name }}
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
          @if (Entrust::hasRole('owner'))
          <a href="/" class="list-group-item" data-parent="#MainMenu">
            <i class="fa fa-home sidebar-icon"></i>
            <span
              id="menu-txt"
              style="font-size: 16px !important"
              style="font-size: 16px !important"
              style="font-size: 16px !important"
            >
              {{ __("Dashboard") }}</span
            ></a
          >
          <a href="/labels" class="list-group-item" data-parent="#MainMenu"
            ><i class="fas fa-tags sidebar-icon"></i
            ><span id="menu-txt" style="font-size: 16px !important"
              >Tags
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
                    @if (Entrust::can('project-create'))
                    <a href="{{ route('projects.create') }}" id="newProject" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> {{ __("New Project") }}</a>
                    @endif
                </div>

                <a href="#user" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="fa fa-users sidebar-icon"></i
            ><span
              id="menu-txt"
              style="font-size: 16px !important"
              style="font-size: 16px !important"
              style="font-size: 16px !important"
            >
              {{ __("Users") }}</span
            >
            <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i
          ></a>
                <div class="collapse" id="user">
                    <a href="{{ route('productss.index') }}" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i> {{ __("All Users") }}</a>
                    @if (Entrust::can('user-create'))
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

                <a href="#settings" class="list-group-item" data-toggle="collapse" data-parent="#MainMenu" style="font-size: 16px !important"><i class="fa fa-cog sidebar-icon"></i
            ><span id="menu-txt">Report</span>
            <i class="icon ion-md-arrow-dropup arrow-side sidebar-arrow"></i
          ></a>
                <div class="collapse" id="settings">
                    <a href="/digitalrepem" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Digital Report</a>
                    <a href="/report" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Excel Report</a>
                    @if (Auth::user()->user_flag == 2)
                    <a href="/testsup" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get QC & Done KPI Report
                    </a>
                    @else
                    <a href="/test" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get QC & Done KPI Report
                    </a>
                    @endif @if (Auth::user()->user_flag == 2)
                    <a href="/overduesup" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Deadline Tasks Report
                    </a>
                    @else
                    <a href="/overdue" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Deadline Tasks Report
                    </a>
                    @endif @if (Auth::user()->user_flag == 2)
                    <a href="/menusssup" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Duration Progressing-Done
                    </a>
                    @else
                    <a href="/menuss" class="list-group-item childlist" style="font-size: 13px !important">
                        <i class="bullet-point"><span></span></i>Get Duration Progressing-Done
                    </a>
                    @endif
                </div>

                @if (Entrust::hasRole('owner'))
                <div class="collapse" id="settings">
                    <a href="{{ route('roles.index') }}" class="list-group-item childlist" style="font-size: 16px !important">
                        <i class="bullet-point"><span></span></i> {{ __("Role & Permissions Management") }}</a>
                </div>
                @endif @if (Entrust::hasRole('owner'))
                <div class="collapse" id="settings">
                    <a href="{{ route('roles.index') }}" class="list-group-item childlist">
                        <i class="bullet-point"><span></span></i> {{ __("Role & Permissions Management") }}</a>
                </div>
                @endif
            </div>
        </nav>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="global-heading">@yield('heading')</h1>
                        @yield('content')
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>

            @endif @if (Session::has('flash_message_warning'))
            <message message="{{ Session::get('flash_message_warning') }}" type="warning"></message>
            @endif @if (Session::has('flash_message'))
            <message message="{{ Session::get('flash_message') }}" type="success"></message>
            @endif
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

    @if (App::getLocale() == 'dk')
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
                format: "dd/mm/yyyy",
                formatSubmit: "yyyy/mm/dd",
            });
        });
    </script>
    @endif @stack('scripts')

    <script>
        window.trans =
            <?php
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