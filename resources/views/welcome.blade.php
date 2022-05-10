<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EraPro Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dashboard//css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="https://cdn.erakomp.co.id/assets/Icon%20logo%20kanban%20board-01.png">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="index.html">
                        <img src="https://cdn.erakomp.co.id/assets/Icon%20logo%20kanban%20board-01.png" alt="logo" style="width:50px!important; height:50px!important;" />
                        <sub><b>V.0.0.1</b></sub>
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">


                            <div id="MyClockDisplay" class="clock" onload="showTime()" style="margin-top:5%!important;">
                            </div>
                            <span class="text-black fw-bold"> Welcome Back
                                {{ Auth::user()->name ?? 'JohnDoe' }}</span>
                        </h1>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class=" rounded-circle" src="{{ Auth::user()->image }}" alt="Profile image"
                                style="max-width:50px!important;"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ Auth::user()->image }}" alt="Profile image" style="max-width:50px!important;">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                                <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>
                            <a class="dropdown-item" href="/userr"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile
                            </a>
                            <a class="dropdown-item" href="{{ url('/logout') }}"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Team review meeting at 3.00 PM
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Prepare for presentation
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Resolve all the low priority tickets due today
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Schedule meeting for next week
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Project review
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                            </ul>
                        </div>
                        <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary me-2"></i>
                                <span>Feb 11 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                            <p class="text-gray mb-0">The total number of sessions</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary me-2"></i>
                                <span>Feb 7 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See
                                All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Other Menus</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <span class="menu-title">Users</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="#">User List</a></li>
                                <li class="nav-item"> <a class="nav-link" href="#">Add User</a></li>
                                <li class="nav-item"> <a class="nav-link" href="#">Divisions</a></li>
                                <li class="nav-item"> <a class="nav-link" href="#">Roles and
                                        Permissions</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item nav-category">Reports</li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Reports</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <p class="statistics-title">Total Projects</p>
                                                        <h3 class="rate-percentage">{{ $getDataProject }}</h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Total Task</p>
                                                        <h3 class="rate-percentage">{{ $getDataTask }}</h3>
                                                    </div>
                                                    <div>
                                                        <p class="statistics-title">Complete Task(s)</p>
                                                        <h3 class="rate-percentage">{{ $getCompTask }} of {{ $getDataTask }} ({{ round(($getCompTask / $getDataTask) * 100) }}%)</h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Incomplete Task(s)</p>
                                                        <h3 class="rate-percentage">{{ $getIncTask }} of {{ $getDataTask }} ({{ round(($getIncTask / $getDataTask) * 100) }}%)</h3>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <p class="statistics-title">Overdue Task(s)</p>
                                                        <h3 class="rate-percentage">{{ $getOv }} of {{ $getDataTask }} ({{ round(($getOv / $getDataTask) * 100) }}%</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Tasks Line Chart</h4>
                                                                    </div>
                                                                    <div id="performance-line-legend"></div>
                                                                </div>
                                                                <div class="chartjs-wrapper mt-5" style="height:500px!important;">
                                                                    <canvas id="canvas"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                        <div class="card bg-primary card-rounded">
                                                            <div class="card-body pb-0">
                                                                <h4 class="card-title card-title-dash text-white mb-4">
                                                                    Status Summary</h4>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <p class="status-summary-ight-white mb-1">
                                                                            Closed Value</p>
                                                                        <h2 class="text-info">
                                                                            {{ $getDataProject }}</h2>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="status-summary-chart-wrapper pb-4">
                                                                            <canvas id="status-summary"></canvas>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <canvas id="pie-chart" width="100%" height="100%"></canvas>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                                                            <div class="circle-progress-width">
                                                                                <div id="totalVisitors" class="progressbar-js-circle pr-2">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h4 class="card-title card-title-dash">Active Users
                                                                        </h4>
                                                                        <p class="card-subtitle card-subtitle-dash">You have {{ $getUserList }} active members
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive  mt-1">
                                                                    <table class="table select-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Member Since</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($getUser as $i)
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="d-flex ">
                                                                                        <img src="{{ $i->image }}" alt="">
                                                                                        <div>
                                                                                            <h6>{{ $i->name }}
                                                                                            </h6>
                                                                                            <p>{{ $i->email }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <h6>
                                                                                        {{date('l, d/m/y H:i:s', strtotime($i->created_at))}}
                                                                                    </h6>
                                                                                </td>
                                                                                <td>
                                                                                    @if ($i->deleted_at == null)
                                                                                    <div class="badge badge-opacity-success">
                                                                                        Active</div>
                                                                                    @else
                                                                                    <div class="badge badge-opacity-danger">
                                                                                        Inactive</div>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 d-flex flex-column">
                                                <div class="row flex-grow">
                                                    <div class="col-12 grid-margin stretch-card">
                                                        <div class="card card-rounded">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <h4 class="card-title card-title-dash">Top Performer
                                                                            </h4>
                                                                        </div>`
                                                                        <div class="list-wrapper">
                                                                            @foreach ($most as $i)
                                                                            <div class="align-items-center">
                                                                                <div class="card" style="margin-top:7%;">
                                                                                    <img class="card-img-top " src="{{ $i->image }}" alt="profile">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">{{ $i->name }}</h5>
                                                                                        <p class="card-text">
                                                                                            {{ $i->finish_tasks}} of {{ $i->total_tasks }} ({{ round(($i->jml)) }}%)
                                                                                        </p>
                                                                                        <p class="btn btn-warning">{{ \Carbon\Carbon::parse($i->created_at)->diffForHumans() }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">EraPro<sub>
                                V.0.0.1</sub></span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All
                            rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('dashboard/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('dashboard/js/template.js') }}"></script>
    <script src="{{ asset('dashboard/js/settings.js') }}"></script>
    <script src="{{ asset('dashboard/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('dashboard/js/dashboard.js') }}"></script>

    <script src="{{ asset('dashboard/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->
</body>
<script>
    function showTime() {
        var date = new Date();
        var h = date.getHours();
        var m = date.getMinutes();
        var s = date.getSeconds();
        var session = "AM";

        if (h == 0) {
            h = 12;
        }
        if (h > 12) {
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);
    }
    showTime();
</script>

<script>
    $(function() {
        //get the pie chart canvas
        var cData = JSON.parse(`<?php echo $chart_data; ?>`);
        var ctx = $("#pie-chart");
        //pie chart data
        var data = {
            labels: cData.division,
            datasets: [{
                label: "Task Count",
                data: cData.data,
                backgroundColor: [
                    "#00ff51",
                    "#eeff00",
                    "#ff0000",
                    "#00a2ff",
                    "#ff00ff",
                    "#000000",
                ],
                borderColor: [
                    "#CDA776",
                    "#989898",
                    "#CB252B",
                ],
                borderWidth: [2, 1, 1]
            }]
        };
        //options
        var options = {
            responsive: true,
            width: 300,
            radius: 10,
            title: {
                display: true,
                position: "top",
                text: "Total Users Based On Divisions",
                fontSize: 21,
                marginBottom: 15,
                fontColor: "#111"
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontColor: "#333",
                    fontSize: 16
                }
            },
        };
        //create Pie Chart class object
        var chart1 = new Chart(ctx, {
            type: "pie",
            data: data,
            options: options,
        });
    });
</script>

<script>
    var year = <?php echo $year; ?>;
    var user = <?php echo $user; ?>;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Tasks',
            backgroundColor: "pink",
            data: user
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Yearly Tasks Created By Users'
                }
            }
        });
    };
</script>

</html>