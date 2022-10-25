@extends('layouts.master')
@section('heading')
    
@stop

@section('content')

<div class="row">
    @if(Auth::check() && Auth::user()->flag == 1)
    @foreach ($getProject->where('flag', 1) as $item)
    {{-- ganti nama project --}}
    {{-- <a href="{{route("projects.show", $item->id)}}"> --}}
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, "-")}}">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;white-space:none!important;">
            <div class="inner" style="min-height: 100px">
                <div class="" style="width:30px;">
                    <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; width:40px!important;">
                        {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                    </h3>
                </div>
                
                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 2)
    @foreach ($getProject->where('flag', 2) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 3)
    @foreach ($getProject->where('flag', 3) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 4)
    @foreach ($getProject->where('flag', 4) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 5)
    @foreach ($getProject->where('flag', 5) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 6)
    @foreach ($getProject->where('flag', 6) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 7)
    @foreach ($getProject->where('flag', 7) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 8)
    @foreach ($getProject->where('flag', 8) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 9)
    @foreach ($getProject->where('flag', 9) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 10)
    @foreach ($getProject as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 11)
    @foreach ($getProject->where('flag', 11) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 12)
    @foreach ($getProject->where('flag', 12) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 13)
    @foreach ($getProject->where('flag', 13) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @elseif(Auth::check() && Auth::user()->flag == 14)
    @foreach ($getProject->where('flag', 14) as $item)
    
    <a href="{{route("projects.show", $item->id).'-'.str_slug($item->title, " -")}}" class="">

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box " style="border-radius: 20px; background-color:rgba(255, 255, 255, 0.5); padding:5%;">
            <div class="inner" style="min-height: 100px">
                
                <h3 style="color:rgb(63, 63, 63)!important; font-size:25px!important; max-width:40px!important;">
                    {!! \Illuminate\Support\Str::limit($item->title, 15, $end='...') !!}
                </h3>

                <p style="color:rgb(63, 63, 63)!important; font-size:15px!important;"> {{date('l, d-m-Y H:i:s', strtotime($item->created_at))}}</p>
                <form action="{{ route('projects.destroy',$item->external_id) }}" method="POST" style="display:flex; justify-content:right; ">
                @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
                <!--<a href="{{route("projects.show", $item->external_id)}}" class="btn btn-link"><i
                    class="fa fa-arrow-circle-right" style="color:rgb(63, 63, 63)!important; font-size:30px!important;"></i></a>-->
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
</a>

    @endforeach
    @endif
    <!--<div class="col-lg-3 col-xs-6">
      small box
        <div class="small-box " style="border-radius: 20px; background-color:rgba(0, 0, 0, 0.349);">
            <div class="inner" style="min-height: 100px">
                
                <a href="/projects/create"><h3 style="color:white!important; font-size:25px!important;">
                    Add New Project
                </h3></a>

                
            </div>
            <div class="icon">
                <i class="ion ion-ios-book-outline"></i>
            </div>
           
                        
        </div>
    </div>
   
</div>-->
    <!--<table class="table table-hover" id="projects-table">
        <thead>
        <tr>

            <th>{{ __('Title') }}</th>
            <th>{{ __('Deadline') }}</th>
            <th>{{ __('Created at') }}</th>
            <th>{{ __('Assigned') }}</th>
            <th>
                <select name="status_id" id="status-task" class="table-status-input">
                    <option value="" disabled>{{ __('Status') }}</option>
                    @foreach($statuses as $status)
                        <option class="table-status-input-option" {{ $status->title == 'Open' ? 'selected' : ''}} value="{{$status->title}}">{{$status->title}}</option>
                    @endforeach
                    <option value="all">@lang('All')</option>
                </select>
            </th>
        </tr>
        </thead>
    </table>-->

      <!-- DELETE MODAL SECTION -->
      <div id="deletion" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <form method="POST" id="deletion-form" >
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@lang('Delete Project ') <span id="deletion-title"></span></h4>
            </div>
            <div class="modal-body">
   
            @method('delete')
            @csrf
            
            <p>
            @lang('When you click the delete button it will delete the project directly').
            </p>
            <label style="font-weight: 300; color:#333; font-size:14px;">
                <input type="checkbox" name="delete_tasks"> Agree 
            </label>
            
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
            {{-- <input type="submit" action="{{route('projects.destroy', $getProject->external_id) }}" class="btn btn-brand" value="{{__('Delete')}}"> --}}
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END OF THE EDIT MODAL SECTION -->
@stop

