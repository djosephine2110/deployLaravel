<div class="row">
    <div class="col-md-4" style="font-size:14px!important;">{{ __('Assigned') }}</div>
    <div class="col-md-8">
        <span id="assignee-user" class="siderbar-list-value" style="font-size:14px!important;">{{$tasks->user->name}}
            @if(Entrust::can('can-assign-new-user-to-task'))
            <i class="icon ion-md-create"></i>
            @endif
        </span>

        @if(Entrust::can('can-assign-new-user-to-task'))
        @if(!$tasks->isClosed())
        <span id="assignee-picker" class="hidden">
            <form method="POST" action="{{url('tasks/updateassign', $tasks->external_id)}}">
                {{csrf_field()}}
                <select name="user_assigned_id"
                    class="small-form-control bootstrap-select assignee-selectpicker dropdown-user-selecter pull-right"
                    id="user-search-select" data-live-search="true" data-style="btn btn-sm dropdown-toggle btn-light"
                    data-container="body" onchange="this.form.submit()">
                    @foreach($users as $key => $user)
                    <option data-tokens="{{$user}}" {{$tasks->user_assigned_id == $key ? 'selected' : ''}}
                        value="{{$key}}">{{$user}}
                    </option>
                    @endforeach
                </select>
            </form>
        </span>
        @endif
        @endif

    </div>
</div>
<div class="row margin-top-10">
    <div class="col-md-4" style="font-size:14px!important;">Created Date</div>
    <div class="col-md-8" style="font-size:14px!important;">
        {{date('l, d/m/y H:i:s', strtotime($tasks->created_at))}}
    </div>
</div>
<div class="row margin-top-10">
    <div class="col-md-4">{{ __('Deadline') }}</div>
    <div class="col-md-8">
        <span {{Entrust::can('task-update-deadline') ? 'data-toggle=modal data-target=#ModalUpdateDeadline' : '' }}
            class="siderbar-list-value {{$tasks->isCloseToDeadline() ? 'text-danger' : ''}}">{{date('l, d-m-y H:i:s',
            strtotime($tasks->deadline))}}
            @if($tasks->status_id != 7)
            <span class="small text-black">({!! $tasks->days_until_deadline !!})</span>
            @endif
            @if(Entrust::can('task-update-deadline'))
            <i class="icon ion-md-create"></i>
            @endif
        </span>


    </div>
</div>

<!--Label-->

<div class="row margin-top-10">
    <div class="col-md-4">{{ __('Status') }}</div>
    <div class="col-md-8">
        <span id="status-text" class="siderbar-list-value">
            {{ $tasks->status->title }}
            @if(Entrust::can('task-update-status'))
            <i class="icon ion-md-create"></i>
            @endif
        </span>
        @if(Entrust::can('task-update-status'))
        @if(!$tasks->isClosed())
        <span id="status-picker" class="hidden">
            <form method="POST" action="{{url('tasks/updatestatus', $tasks->id)}}">
                {{csrf_field()}}
                <select name="status_id"
                    class="small-form-control bootstrap-select status-selectpicker dropdown-user-selecter"
                    id="status-search-select" data-style="btn btn-sm dropdown-toggle btn-light" data-container="body"
                    onchange="this.form.submit()">
                    @if(Entrust::hasRole('owner'))
                    @foreach($statuses as $key => $status)
                    <option {{$tasks->status->id == $key ? 'selected' : ''}} value="{{$key}}">{{$status}}</option>
                    @endforeach
                    @else
                    @foreach($statuses->except('id',7)->except('id', 6) as $key => $status)
                    <option {{$tasks->status->id == $key ? 'selected' : ''}} value="{{$key}}">{{$status}}</option>
                    @endforeach
                    @endif
                </select>
            </form>
        </span>
        @endif
        @endif
    </div>
</div>

<div class="row margin-top-10">
    <div class="col-md-4">{{ __('Project') }}</div>
    <div class="col-md-8">
        <span id="project-text" class="siderbar-list-value">
            {{ !is_null($tasks->project) ? $tasks->project->title : __('None') }}
            @if(Entrust::can('task-update-status'))
            <i class="icon ion-md-create"></i>
            @endif
        </span>
        @if(Entrust::can('task-update-linked-project'))
        <span id="project-picker" class="hidden">
            <form method="POST" action="{{route('tasks.update.project', $tasks->id)}}">
                {{csrf_field()}}
                <select name="project_external_id"
                    class="small-form-control bootstrap-select project-selectpicker dropdown-user-selecter pull-right"
                    id="project-search-select" data-style="btn btn-sm dropdown-toggle btn-light" data-container="body"
                    onchange="this.form.submit()">
                    <option value=""></option>
                    @foreach($projects as $key => $project)
                    <option {{optional($tasks->project)->external_id == $key ? 'selected' : ''}}
                        value="{{$key}}">{{$project}}</option>
                    @endforeach
                </select>
            </form>
        </span>
        @endif
    </div>
</div>
<div class="row margin-top-10">
    <div class="col-md-4">Label</div>
    <div class="col-md-8">
        @if(($tasks->getlabel == " " || $tasks->getlabel == NULL ))
        <span>no label added</span> <a href="{{ route('taskss.edit',$tasks->id) }}"><i class="fas fa-edit"></i></a>
        @else
        <button class="btn"
            style="background-color: {{$tasks->getcolor}}; color:white; border-radius:50px; width:120px; font-weight:800; height:20px; padding:1px; margin-right:5px;pointer-events:none; ">{{$tasks->getlabel}}</button>
        <a href="{{ route('taskss.edit',$tasks->id) }}"><i class="fas fa-edit"></i></a>
        @endif
        <form action="{{ route('tasks.destroy',$tasks->id).'-'.str_slug($tasks->title, " -") }}" method="POST"
            style="display:flex; margin-top:5%; ">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Delete Task
            </button>
        </form>
        @if(Entrust::can('task-update-linked-project'))
        <span id="project-picker" class="hidden">
            <form method="POST" action="{{route('tasks.update.project', $tasks->id)}}">
                {{csrf_field()}}
                <select name="project_external_id"
                    class="small-form-control bootstrap-select project-selectpicker dropdown-user-selecter pull-right"
                    id="project-search-select" data-style="btn btn-sm dropdown-toggle btn-light" data-container="body"
                    onchange="this.form.submit()">
                    <option value=""></option>
                    @foreach($label as $key )
                    <option value="{{$key->price}}">{{$key->name}}</option>
                    @endforeach
                </select>
            </form>
        </span>
        @endif
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
            $('select').selectpicker();

            $('#assignee-user').on('click',function(){
                if($("#assignee-picker").hasClass("hidden")) {
                    $("#assignee-picker").removeClass("hidden");
                    $("#assignee-user").addClass("hidden");

                    $('.assignee-selectpicker').selectpicker('toggle')
                }
            });

            $('body').on('click',function(e){
                var container = $("#assignee-picker");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0)
                {
                    if ($("#assignee-user").is(e.target)) {
                        return
                    }

                    container.addClass("hidden");
                    $("#assignee-user").removeClass("hidden");
                }

            });

            $('#status-text').on('click',function(){
                if($("#status-picker").hasClass("hidden")) {
                    $("#status-picker").removeClass("hidden");
                    $("#status-text").addClass("hidden");

                    $('.status-selectpicker').selectpicker('toggle')
                }
            });


            $('#project-text').on('click',function(){
                if($("#project-picker").hasClass("hidden")) {
                    $("#project-picker").removeClass("hidden");
                    $("#project-text").addClass("hidden");

                    $('.project-selectpicker').selectpicker('toggle')
                }
            });

            $('body').on('click',function(e){
                var container = $("#status-picker");
                var containerTwo = $("#project-picker");

                // if the target of the click isn't the container nor a descendant of the container
                if (!container.is(e.target) && container.has(e.target).length === 0)
                {
                    if ($("#status-text").is(e.target)) {
                        return
                    }

                    container.addClass("hidden");
                    $("#status-text").removeClass("hidden");
                }
                                // if the target of the click isn't the container nor a descendant of the containerTwo
                if (!containerTwo.is(e.target) && containerTwo.has(e.target).length === 0)
                {
                    if ($("#project-text").is(e.target)) {
                        return
                    }

                    containerTwo.addClass("hidden");
                    $("#project-text").removeClass("hidden");
                }

            });
        });
        window.addEventListener("load", function() {
    var now = new Date();
    var utcString = now.toISOString().substring(0,19);
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
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
@endpush