@extends('layouts.master')

@section('content')
<div class="card shadow" style="background-color: white;">
    <div class="card-body">
        <div class="container" style="padding: 5%;">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12 margin-tb">
                    <a href="/tasks/{{$comment->task->id.'-'.str_slug($comment->task->title, "-")}}"><div class="btn btn-md btn-brand movedown">Back</div></a>
                    <div class="">
                        <h1 style="text-transform: uppercase; font-weight:bold; text-align:center">Edit Comment</h1>
                    </div>
                </div>
            </div>
        
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <form action="{{ route('comments.update',$comment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row" style="display: flex; justify-content:center;">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <strong>Comment :</strong>
                            
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{-- {!! $comment->description !!} --}}
                            {{-- {{strip_tags($comment->description)}} --}}
                       <input type="text" placeholder="{{strip_tags($comment->description)}}" value="{{strip_tags($comment->description)}}" name="description" style="width: 400px;">
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                            <strong>Comment :</strong>
                            <textarea type="text" name="description" value="{!! $comment->description !!}" class="form-control" ></textarea>
                        </div>
                    </div> --}}
                    {{-- <div class="col-sm-6" style="display: none;">
                        <div class="form-group">
                            <strong>Type:</strong>
                            <input type="text" name="source_type" value="{{ $comment->source_type }}" class="form-control">
                        </div>
                    </div> --}}
                
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                       

                        <button type="submit" class="btn btn-md btn-brand movedown">Update</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
   
@endsection
