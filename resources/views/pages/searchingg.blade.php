@extends('layouts.master')
<style>
    .card ul.pagination{
        display: flex!important;
        justify-content: center!important;
    }
    div.input-field.col.s12{
        display: flex!important;
        justify-content: center!important;
    }
</style>
@section('content')

<div class="card" style="background-color:transparent;">
    <div class="container">
        <div class="card-body">
            <h1 style="font-family: 'Fredericka the Great', cursive; font-size:70px; text-align:center; margin:15%;
            ">ERAKOMP PROJECT MANAGEMENT</h1>
        </div>
        <form action="{{ url('query') }}" method="GET">
            <div class="row" style="margin-top:-10%;">
                  <div class="input-field col s12">
                    <input type="text" class="validate" name="q" style="margin-right:5px;">
                    <button type="submit" class="btn btn-flat pink accent-3 waves-effect waves-light white-text right" style="margin-right:5px;">search</button>
                    <button class="btn btn-flat pink accent-3 waves-effect waves-light white-text right" style="color: black;"><a href="/query/">refresh</a></button>
                  </div>
                  
            </div>
         </form>
         @if (count($hasil))
         <div class="card-panel green white-text" style="text-align:center; font-weight:bold;">Hasil pencarian : {{$query}}</div>
             @foreach($hasil as $data)
             <div class="row">
                 <div class="col s12">
                     <h5 style="text-align:center; color:black;"><a href="/tasks/{{$data->id}}"  style="text-align:center; color:black;">{{ $data->title }}</a></h5>
         
                     <div class="divider"></div>
                        
                     {{-- <a href="{{ url('read', $data->id) }}" class="btn btn-flat pink accent-3 waves-effect waves-light white-text">Readmore <i class="material-icons right">send</i></a>
                     <a href="{{ url('edit', $data->id) }}" class="btn btn-flat purple darken-4 waves-effect waves-light white-text">Edit <i class="material-icons right">mode_edit</i></a>
                     <a href="{{ url('delete', $data->id) }}" onclick="return confirm('Yakin mau hapus data ini sob?')" class="btn btn-flat red darken-4 waves-effect waves-light white-text">Delete <i class="material-icons right">delete</i></a> --}}
                 </div>
             </div>
             @endforeach
         
         </div>
         
         {{ $hasil->appends(['q' => $query])->render() }}
             
         @else
            <div class="card-panel red darken-3 white-text">Oops.. Data <b>{{$query}}</b> Tidak Ditemukan</div>
         @endif
        
    </div>
    </div>
    

</div>


        <!-- Small boxes (Stat box) -->
        @if(isDemo())
            <div class="alert alert-info">
                <strong>Info!</strong> 
            </div>
        @endif

      
@endsection
