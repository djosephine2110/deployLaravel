@extends('layouts.master')

@section('content')
<style>
    div.project-board-card-description p img {

        width: 100px !important;
    }

    div.tablet__body.tablet__tigthen img {
        max-width: 100px !important;
    }

    <style>.dropbtn {
        background-color: #4CAF50;
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
        background-color: #f1f1f1
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>

<div class="row">
    @include('partials.clientheader')
    @include('partials.userheader', ['changeUser' => false])
</div>
<h1 style="font-size:25px; font-weight:bold;">Welcome to Board <span
        style="text-transform: uppercase; color:red; font-weight:bold;">'{{ $project->title }}'</span></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="project-board-ui">
            <nav class="navbar board text-black ">
                <a href="/projects" class="btn btn-md btn-brand" style="margin:1em; font-size:14px;">Back</a>

                @if (!$project->isClosed())
                <a href="{{ route('client.project.task.create', [$client->external_id, $project->external_id]) }}"
                    class="btn btn-md btn-brand" style="margin:1em; font-size:14px;">@lang('New task')</a>
                @endif

            </nav>
            <div class="project-board-lists">

                @foreach ($statuses as $status)
                <div class="project-board-list" style="background-color:{{ $status->color }};">
                    <header style="background-color:{{ $status->color }}!important;">{{ __($status->title) }}
                    </header>
                    <ul class="sortable" id="{{ $status->title }}" data-status-external-id="{{ $status->external_id }}"
                        style="max-height: 25em; min-height:30em;">
                        @foreach ($tasks as $task)
                        {{-- rubah task --}}
                        <li data-task-id="{{ $task->id }}">
                            @if ($task->status_id == $status->id)
                            <div class="project-board-card-wrapper">
                                <a href="{{ route('tasks.show', $task->id).'-'.str_slug($task->title, " -") }}" class=""
                                    style="text-decoration: none;">
                                    <div class="project-board-card">
                                        <div class="position-relative">
                                        </div>
                                        <p data-task-title="{{ $task->title }}" class="project-board-card-title"
                                            style="font-size:14px!important; font-weight:bold; width:180px!important; max-width:180px!important;">
                                            {{ $task->title }}
                                            {{--
                                        <div class="dropdown" style="">
                                            <button class="dropbtn">
                                                <div class="spann"></div>
                                            </button>
                                            <div class="dropdown-content" style="left:0;">
                                                <a href="#">Link 1</a>
                                                <a href="#">Link 2</a>
                                                <a href="#">Link 3</a>
                                            </div>
                                        </div> --}}

                                        {{-- <form action="{{ route('tasks.destroy',$task->external_id) }}"
                                            method="POST" style="display:flex; justify-content:right; ">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>
                                            </button>
                                        </form> --}}
                                        <div class="tablet__body tablet__tigthen" style="font-size: 14px!important; ">
                                            <!--<p style="font-size: 12px!important; max-width:300px!important;">  {!! $task->description . '' !!}</p>-->
                                        </div>
                                        </p>
                                        @if ($task->image != null)
                                        <h1 style="text-align: ceter;">
                                            <embed src='{!! $task->image !!}' width="100%" height="100%">
                                        </h1>
                                        @else
                                        <span>

                                        </span>
                                        @endif
                                        <div class="project-board-card-description"
                                            style="font-size:14px!important; width:100px!important; max-width:100px!important;">
                                            @if ($task->getlabel != '')
                                            <p
                                                style="background-color: {{ $task->getcolor }}; text-align:center; border-radius:50px; pointer-events:none!important; color:white;">
                                                {{ $task->getlabel }}</p>

                                            @else
                                            <span></span>
                                            @endif
                                            </button>


                                        </div>
                                    </div>

                                    <div class="project-board-card-footer">
                                        <ul class="list-inline"
                                            style="padding: 8px; min-height: 3.3em; font-size:12px!important;">
                                            {{ date('l, d/m/y H:i', strtotime($task->created_at)) }}

                                            <li class="project-board-card-thumbnail text-right" style="float:right;">
                                                @if ($task->user->image !== null)
                                                <a href="/home" class="topbar-user__list-link">

                                                    <span class="user__list-icon">
                                                        <img src="{{ $task->user->image }}" class="thumbnail" alt=""
                                                            srcset=""
                                                            style="max-width: 45px!important; border-radius:100px; margin-right:-10%;"
                                                            title="{{ $task->user->name }}">
                                                    </span>

                                                </a>

                                                @else
                                                <a href="/home" class="topbar-user__list-link">

                                                    <span class="user__list-icon">
                                                        <img src="https://p.kindpng.com/picc/s/451-4517876_default-profile-hd-png-download.png"
                                                            class="thumbnail" alt="" srcset=""
                                                            style="max-width: 45px!important; border-radius:100px; margin-right:-10%;"
                                                            title="{{ $task->user->name }}">
                                                    </span>

                                                </a>
                                                @endif
                                                <!--<button class="btn" style="pointer-events:none; background-color:turquoise; color:white; font-weight:bold;border-radius:50px; font-size:12px; padding:2px;">{{ $task->user->name }}</button>-->
                                                <!--<a href="{{ route('users.show', $task->user->external_id) }}" ><img src="{{ $task->user->avatar }}" class="project-board-card-thumbnail-image" title="{{ $task->user->name }}"/></a>-->
                                            </li>
                                        </ul>
                                    </div>
                                </a>

                            </div>
                            @endif
                            @endforeach

                        </li>

                    </ul>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row movedown">
    {{-- <div class="col-lg-7">
        <div class="tablet" style="display:none;">
            <div class="tablet__body">
                <h3 class="tablet__head-title">@lang('Project completion progress')</h3>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$completionPercentage}}%;"
                        aria-valuenow="{{$completionPercentage}}" aria-valuemin="0"
                        aria-valuemax="{{$completionPercentage}}">{{$completionPercentage}}%</div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-sm-7">
        <div class="tablet">
            <div class="tablet__head tablet__head__color-brand">
                <div class="tablet__head-label">
                    <h3 class="tablet__head-title text-white" style="font-size:17px!important; font-weight:bold;">
                        @lang('Information')</h3>
                </div>
            </div>
            <div class="tablet__body">
                @include('projects._sidebar')
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="tablet">
            <div class="tablet__body">
                <h3 class="tablet__head-title" style="font-size:17px!important; font-weight:bold;">Collaborator(s)</h3>
                <ul class="list-inline">

                    @foreach ($collaborators as $collaborator)
                    <li>
                        @if ($collaborator->image !== null)
                        <span class="user__list-icon" style="display:flex; justify-content:center;">
                            <img src="{{ $collaborator->image }}" class="action-image" title="{{ $collaborator->name }}"
                                alt="" srcset="" style="max-width: 50px!important; border-radius:100px;">
                        </span>


                        @else

                        <span class="user__list-icon" style="display:flex; justify-content:center;">
                            <img src="https://p.kindpng.com/picc/s/451-4517876_default-profile-hd-png-download.png"
                                class="thumbnail rounded" title="{{ $collaborator->name }}" alt="" srcset=""
                                style="max-width: 50px!important; border-radius:100px;">
                        </span>
                        @endif

                        <!-- <a href="{{ route('users.show', $collaborator->external_id) }}" >
                            <img src="{{ $collaborator->avatar }}" class="project-board-card-thumbnail-image" title="{{ $collaborator->name }}"/>
                        </a>-->
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row movedown">
    {{-- <div class="col-sm-7">
        @include('partials.comments', ['subject' => $project])
    </div> --}}
    {{-- <div class="col-sm-5">
        <div class="tablet">
            <div class="tablet__head tablet__head__color-brand">
                <div class="tablet__head-label">
                    <h3 class="tablet__head-title text-white" style="font-size:17px!important; font-weight:bold;">
                        @lang('Information')</h3>
                </div>
            </div>
            <div class="tablet__body">
                @include('projects._sidebar')
            </div>
        </div>
    </div> --}}
    <div class="col-sm-4">
        @if (Entrust::can('project-upload-files') && $filesystem_integration)
        <div id="document" class="tab-pane">
            <div class="tablet">
                <div class="tablet__head">
                    <div class="tablet__head-label">
                        <h3 class="tablet__head-title">{{ __('All Files') }}</h3>
                        <button id="add-files" style="
                                    margin-left: 30rem !important;
                                    border: 0;
                                    padding: 0;
                                    background: transparent;
                                    font-size:2em;">
                            <i class="icon ion-md-add-circle text-right"></i>
                        </button>
                    </div>

                </div>
                <div class="tablet__body">
                    @if ($files->count() == 0)
                    <div class="tablet__item">
                        <div class="tablet__item__pic">
                            <p class="title">@lang('No files')</p>
                        </div>
                    </div>
                    @endif
                    <div class="tablet__items">
                        @foreach ($files as $file)
                        <div class="tablet__item">
                            <div class="tablet__item__pic">
                                <img src="{{ url('images/doc-icon.svg') }}" alt="">
                            </div>
                            <div class="tablet__item__info">

                                <a href="{{ route('document.view', $file->external_id) }}" class="tablet__item__title"
                                    target="_blank">{{ $file->original_filename }}</a>
                                <div class="tablet__item__description">
                                    {{ $file->size }} MB
                                </div>
                            </div>
                            <div class="tablet__item__toolbar">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon ion-md-more" style="font-size: 2.5em;"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="tablet__nav">
                                            <li class="nav-item">
                                                <a href=" {{ route('document.view', $file->external_id) }}"
                                                    target="_blank" class="nav-link">
                                                    <i class="icon ion-md-eye"></i>
                                                    <span class="nav-link-text">@lang('View')</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href=" {{ route('document.download', $file->external_id) }}"
                                                    target="_blank" class="nav-link">
                                                    <i class="icon ion-md-cloud-download"></i>
                                                    <span class="nav-link-text">@lang('Download')</span>
                                                </a>
                                            </li>
                                            @if (Entrust::can('document-delete'))
                                            <li class="nav-item">
                                                <span class="nav-link">
                                                    <i class="icon ion-md-trash"></i>
                                                    <form method="POST"
                                                        action="{{ action('DocumentsController@destroy', $file->external_id) }}">
                                                        <input type="hidden" name="_method" value="delete" />
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <button type="submit" class="btn btn-clean nav-link-text">{{
                                                            __('Delete') }}</button>
                                                    </form>
                                                </span>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        @endif
    </div>
</div>


@if (Entrust::can('project-update-deadline'))
<div class="modal fade" id="ModalUpdateDeadline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('Change deadline') }}</h4>
            </div>

            <div class="modal-body">

                {!! Form::model($project, [
                'method' => 'PATCH',
                'route' => ['project.update.deadline', $project->id],
                ]) !!}
                {!! Form::label('deadline_date', __('Change deadline'), ['class' => 'control-label']) !!}
                {!! Form::date('deadline_date', \Carbon\Carbon::now()->addDays(7), ['class' => 'form-control']) !!}
                {!! Form::text('deadline_time', '15:00', ['class' => 'form-control', 'onkeydown' => 'return
                isNumberKey(this)', 'onchange' => 'validateHhMm(this)', 'id' => 'deadline_time']) !!}




                <div class="modal-footer">
                    <button type="button" class="btn btn-default col-lg-6" data-dismiss="modal">{{ __('Close')
                        }}</button>
                    <div class="col-lg-6">
                        {!! Form::submit(__('Update deadline'), ['class' => 'btn btn-success form-control closebtn'])
                        !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="modal fade" id="add-files-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(".sortable").sortable({
        axis: 'X',
        connectWith: '.sortable',
        receive: function (event, ui,) {
            var taskExternalId = ui.item.attr('data-task-id');
            var taskExternalTitle = ui.item.attr('data-task-title');
            var statusExternalId = $(this).attr('data-status-external-id')
            var url = '{{ route('task.update.status', ':taskExternalId' .'-' .'taskExternalTitle') }}';
        url = url.replace(':taskExternalId', taskExternalId);
        // POST to server using $.post or $.ajax
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}",
                "statusExternalId": statusExternalId,
                "test": $(this).parent().attr('id')
            },
            type: 'PATCH',
            url: url
        });
    }
        });
    @if (Entrust:: can('project-upload-files') && $filesystem_integration)
    $('#add-files').on('click', function () {
        $('#add-files-modal .modal-content').load('/add-documents/{{ $project->external_id }}' + '/project');
        $('#add-files-modal').modal('show');
    });
    @endif

    $('div.tablet__body.tablet__tigthen img').attr('style',
        'max-width: 210px !important; display:flex!important; justify-content:center; ');
</script>

@endpush