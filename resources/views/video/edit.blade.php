@extends('layouts.app')

@section('content')
<div class="container">
<h2>Registrar nuevo video</h2>
<hr>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
             <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <form method="post" action="{{route('posteditVideo')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$video->id}}" require>
        <div class="form-group">
            <h4 for="title" >Title</h4>
            <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">
        </div>

        <div class="form-group">
            <label for="description">Descripcion</label>
            <textarea class="form-control" id="description" name="description"cols="20" rows="5">{{$video->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="title">Imagen</label>
            <div>
                <img alt="{{ $video->image }}" src="{{ route('imageVideo',$video->image) }}" class="img-thumbnail" width="350" height="200">
                <input type="file" class="form-control" id="image" name="image"  accept=".jpg, .jpeg, .png">
            </div>
        </div>

        <div class="form-group">
            <label for="title">Video</label>
            <div>
                <video controls id="Video-player" width="350" height="200">
                    <source src="{{ route('videoVideo',$video->video_path) }}" type="video/mp4" >
                    tu navegar no es compatible con HTML 5
                </video>
                <input type="file" class="form-control" id="video" name="video" value="{{$video->video_path}}">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection


