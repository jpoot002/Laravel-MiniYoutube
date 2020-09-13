@extends('layouts.app')
<link href="{{ URL::asset('css/home.css') }}" rel="stylesheet">
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <button class="close" data-dismiss="alert" ><span aria-hidden="true">&times;</span> </button>
        </div>
    @endif


    <div class="containervideo ">
        <video class="embed-responsive embed-responsive-21by9" autoplay loop controls >
          <source  class="embed-responsive-item" src="{{ route('videoVideo',$video->video_path) }}" type="video/mp4"/>
        </video>
        <div class="salto">
            <h4 >{{ $video->title }}</h4>
             <p class="card-text"><small class="text-muted"> creado por {{ $video->user->name }} / {{ \FormatTime::LongTimeFilter($video->created_at) }}</small></p>
            <hr>
        </div>

        <form class="col-md-auto" method="POST" action="{{route('guardarcomentario')}}">
        @csrf
            <input type="hidden" name="id" value="{{$video->id}}" require>
            <p>
                <textarea name="body" class="form-control" require></textarea>
            </p>
            <button type="submit" class="btn btn-success">Comentario</button>
        </form>

        <h4>comentario</h4>
        <div class=" col-md-auto">
            <ul class="anyClass">
            @foreach($comments as $commen)
            <div class="row">
                <div class="col-md-auto ">
                    <h5><b>{{$commen->user->name}}</b></h5>
                </div>
                <div class="col ">
                    {{FormatTime::LongTimeFilter($commen->created_at)}}
                </div>
            </div>
                <h5>{{$commen->body}}</h5>
                <hr>
            @endforeach
            </ul>
        </div>
    </div>
@endsection
