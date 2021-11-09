@extends('layouts.master')

@section('content')

<div class="card" style="background-color:rgba(255, 255, 255, 0.637);">
    <div class="card-body">
        <h1 style="font-family: 'Fredericka the Great', cursive; font-size:70px; text-align:center; margin:15%;
        ">ERAKOMP PROJECT MANAGEMENT</h1>
    </div>
    
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            if(!'{{$settings->company}}') {
                $('#modal-create-client').modal({backdrop: 'static', keyboard: false})
                $('#modal-create-client').modal('show');
            }
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top

            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true,

                });
            });
        });
        $(document).ready(function () {
            if(!getCookie("step_dashboard") && "{{$settings->company}}") {
                $("#clients").addClass("in");
                // Instance the tour
                var tour = new Tour({
                    storage: false,
                    backdrop: true,
                    steps: [
                        {
                            element: ".col-lg-12",
                            title: "{{trans("Dashboard")}}",
                            content: "{{trans("WELCOME!!")}}",
                            placement: 'top'
                        },
                        {
                            element: "#myNavmenu",
                            title: "{{trans("Navigation")}}",
                            content: "{{trans("Your Navigation menu")}}"
                        }
                    ]
                });

                var canCreateClient = '{{ auth()->user()->can('client-create') }}';
                if(canCreateClient) {
                    tour.addSteps([
                        {
                            element: "#newClient",
                            title: "{{trans("Create New Client")}}",
                            content: "{{trans("")}}"
                        },
                        {
                            path: '/clients/create'
                        }
                    ])
                }

                // Initialize the tour
                tour.init();

                tour.start();
                setCookie("step_dashboard", true, 1000)
            }
            function setCookie(key, value, expiry) {
                var expires = new Date();
                expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 2000));
                document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
            }

            function getCookie(key) {
                var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
                return keyValue ? keyValue[2] : null;
            }
        });
    </script>
@endpush
        <!-- Small boxes (Stat box) -->
        @if(isDemo())
            <div class="alert alert-info">
                <strong>Info!</strong> Data on the demo environment is reset every 24hr.
            </div>
        @endif

      
@endsection
