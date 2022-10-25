@extends('layouts.master')
@section('heading')
    <strong>CREATE TASK</strong>
@stop

@section('content')

    <div class ="row">
        <form action="{{route('tasks.store')}}" method="POST" id="createTaskForm" enctype="multipart/form-data">
            
            <div class="col-sm-8">
                <div class="tablet">
                    <div class="tablet__body">
                            <div class="form-group">
                                <label for="title" class="control-label thin-weight">@lang('Title')</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="ex. whatever you want to put">
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label thin-weight">@lang('Description')</label>
                                <textarea name="description" id="description" cols="50" rows="10" class="form-control"></textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label for="image" class="control-label thin-weight">Image</label>
                                <input type="file" name="image" id="image" class="form-control" >
                            </div> --}}
                    </div>
                </div>
                @if(Entrust::can('task-upload-files') && $filesystem_integration)
                    <div class="tablet">
                        <div class="tablet__body">
                                <label class="control-label">@lang('Files')</label>
                                <div class="dropzone dz-default dz-message" id="dropzone-images">
                                    <span>@lang('Drop files here or click to upload')</span>
                                </div>

                        </div>
                    </div>
                @endif
            </div>
            <div class="col-sm-4">
                <div class="tablet">
                    <div class="tablet__body">
                        <div class="form-group">
                            <label for="user_assigned_id" class="control-label thin-weight">@lang('Assign user')</label>
                            <select name="user_assigned_id" id="user_assigned_id" class="form-control">
                                
                                @if(Auth::check() && Auth::user()->flag == 1)

                                @foreach($getUsers->where('flag', 1) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 2)

                                @foreach($getUsers->where('flag',2) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 3)

                                @foreach($getUsers->where('flag',3) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 4)

                                @foreach($getUsers->where('flag',4) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 5)

                                @foreach($getUsers->where('flag',5) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 6)

                                @foreach($getUsers->where('flag',6) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 7)

                                @foreach($getUsers->where('flag',7) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 8)

                                @foreach($getUsers->where('flag',8) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 9)

                                @foreach($getUsers->where('flag',9) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 10)

                                @foreach($getUsers->where('flag',10) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @elseif(Auth::check() && Auth::user()->flag == 11)

                                @foreach($getUsers->where('flag',11) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @else 

                                @foreach($getUsers->where('flag', 12) as $user )
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            @if(Request::get('client') != "" || $client)
                                <input type="hidden" name="client_external_id" value="{!! Request::get('client') ?: $client->external_id !!}">
                            @else
                                <label for="client_external_id" class="control-label thin-weight">@lang('Assign client')</label>
                                
                                <select 
                                name="client_external_id" 
                                id="client_external_id" 
                                data-container="body" 
                                data-live-search="true" 
                                data-style-base="form-control"
                                data-style=""
                                data-width="100%">
                                    @if($clients->isEmpty())
                                        <option value="" default></option>
                                        <option value="new_client">+ @lang('Create New Client')</option>
                                    @endif
                                    @foreach($clients as $client => $clientK)
                                        <option value="{{$client}}" data-tokens="{{$clientK}}">{{$clientK}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        @if($projects)
                        <div class="form-group" style="display:none!important;">
                            <label for="project_external_id" class="control-label thin-weight">@lang('Assign project')</label>
                            <select name="project_external_id" id="project_external_id" class="form-control">
                                <option value=""></option>
                                @foreach($projects as $projectLoop => $projectLoopK)
                                <option value="{{$projectLoop}}" 
                                {{$projectLoop === optional($project)->external_id ? 'selected' : ''}}
                                >{{$projectLoopK}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="deadline" class="control-label thin-weight">@lang('Deadline') <small>Not necessary</small></label>
                            <input type="datetime-local"  name="deadline"  class="form-control" value="{{Carbon::now()->toDateTimeLocalString()}}" >
                        </div>
                      
                        <div class="form-group">
                            <label for="status_id" class="control-label thin-weight">Position</label>
                            <select name="status_id" id="status" class="form-control">
                                @foreach($statuses as $status => $statusK)
                                    <option value="{{$status}}">{{$statusK}}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="title" class="control-label thin-weight">Label Title</label>
                            <input type="text" name="getlabel" id="getlabel" class="form-control" placeholder="Ex. Important">
                        </div>
                        <div class="form-group">
                            <label for="getcolor" class="control-label thin-weight">Label Color</label>
                            <input type="color" name="getcolor" id="getcolor" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="image" class="control-label thin-weight">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="form-group" style="display:none;">
                            <label for="status_id" class="control-label thin-weight">Division Assigned</label>
                            <input type="text" value="{{Auth::user()->flag}}">
                        </div>
                        <div class="form-group" style="display:none;">
                            <label for="task_status" class="control-label thin-weight">@lang('Status')</label>
                            <select name="task_status" id="task_status" class="form-control">
                                <option value="">Select if any</option>
                                <option value="okay">Okay & Accepted</option>
                                <option value="ur">Under Review</option>
                                <option value="na">Need Attention</option>
                                <option value="error">High Priority / Error</option>

                            </select>
                        </div>
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="submit" class="btn btn-md btn-brand movedown" id="createTask" value="{{__('Create task')}}">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="alert alert-danger title-alert" style="display: none;">
        {{__("Title is required")}}
    </div>
    <div class="alert alert-danger description-alert" style="display: none;">
        {{__("Description is required")}}
    </div>
    <div class="alert alert-danger client-alert" style="display: none;">
        {{__("Client is required")}}
    </div>
@stop

@push('style')
    <style>
        .picker, .picker__holder {
            width: 91%;
        }
    </style>
@endpush
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/summernote-file.js') }}"></script>
    <script>
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $('#client_external_id').selectpicker()

            $('#client_external_id').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var value = $("#client_external_id").val();
                if(value == "new_client") {
                  window.location.href = "/clients/create"
                }
            });

            $('#deadline').pickadate({
                hiddenName:true,
                format: "{{frontendDate()}}",
                formatSubmit: 'yyyy/mm/dd',
                closeOnClear: false,
            });

            $('#description').summernote({
            toolbar: [
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'font', [ 'bold', 'italic', 'underline','clear'] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph'] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'fullscreen' ] ]
            ],
             height:300,
             disableDragAndDrop: true,
             maximumImageFileSize: 1000*1024,


           });

            myDropzone = null;
            @if(Entrust::can('task-upload-files') && $filesystem_integration)
            var myDropzone = new Dropzone("#createTaskForm", {
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 5,
                maxFiles: 50,
                
                addRemoveLinks: true,
                previewsContainer: "#dropzone-images",
                clickable:'#dropzone-images',
                paramName: 'images',
                acceptedFiles: "image/*,application/pdf, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.openxmlformats-officedocument.spreadsheetml.template, application/vnd.openxmlformats-officedocument.presentationml.template, application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.openxmlformats-officedocument.presentationml.slide, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.wordprocessingml.template, application/vnd.ms-excel.addin.macroEnabled.12, application/vnd.ms-excel.sheet.binary.macroEnabled.12,text/rtf,text/plain,audio/*,video/*,.csv,.doc,.xls,.ppt,application/vnd.ms-powerpoint,.pptx, .jpg, .JPG, .JPEG,.jpeg, jpg, jpeg",

            });

            myDropzone.on("success", function(file, response) {
                window.location.href = ("/tasks/"+response.task_external_id)
            });

            myDropzone.on("processing", function(file, response) {
                $('input[type="submit"]').attr("disabled", true);
            });
            myDropzone.on("error", function(file, response) {
                $('input[type="submit"]').attr("disabled", false);
            });

            @endif
            // $('input[type="submit"]').on("click", function (e) {
            //     e.preventDefault();
            //     e.stopPropagation();
            //     if (myDropzone != null && myDropzone.getQueuedFiles().length > 0) {
            //         myDropzone.processQueue();

            //     } else {
            //         $.ajax({
            //             type: 'post',
            //             url: '{{route('tasks.store')}}',
            //             data: $("#createTaskForm").serialize(),
            //             success: function(response){
            //                 if (response.project_external_id) {
            //                     window.location.href = ("/projects/"+response.project_external_id)
            //                 }else {
            //                     window.location.href = ("/tasks/"+response.task_external_id)
            //                 }
            //             },
            //             error: function (jqXHR, textStatus, errorThrown) {
                            
            //                 if (jqXHR.responseJSON.errors.title != undefined) {
            //                     $('.title-alert').show();
            //                 } else {
            //                     $('.title-alert').hide();
            //                 }
            //                 if (jqXHR.responseJSON.errors.description != undefined) {
            //                     $('.description-alert').show();
            //                 }else {
            //                     $('.description-alert').hide();
            //                 }
            //                 if (jqXHR.responseJSON.errors.client_external_id != undefined) {
            //                     $('.client-alert').show();
            //                 }else {
            //                     $('.client-alert').hide();
            //                 }

            //             }
            //         });
            //     }

            // });



        });
        window.addEventListener("load", function() {
    var now = new Date();
    var utcString = now.toISOString().substring(0,19);
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    var localDatetime = year + "-" +
                      (month < 10 ? "0" + month.toString() : month) + "-" +
                      (day < 10 ? "0" + day.toString() : day) + "T" +
                      (hour < 10 ? "0" + hour.toString() : hour) + ":" +
                      (minute < 10 ? "0" + minute.toString() : minute) +
                      utcString.substring(16,19);
    var datetimeField = document.getElementById("cal");
    datetimeField.value = localDatetime;
});


    </script>
    <script>
        window.addEventListener("load", function() {
    var now = new Date();
    var utcString = now.toISOString().substring(0,19);
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    var localDatetime = year + "-" +
                      month.toString() + "-" +
                       day.toString() + "T" +
                       hour.toString()+ ":" +
                       minute.toString()  +
                      utcString.substring(16,19);
    var datetimeField = document.getElementById("myDatetimeField");
    datetimeField.value = localDatetime;
});
    </script>
@endpush
