@extends('layouts.app')
<link href="{{ URL::asset('css/home.css') }}" rel="stylesheet">
@section('content')

<div class="container">
<h2>Registrar nuevo video</h2>
<hr>
    <div class="container">
        <form method="post" action="{{route('guardarvideo')}}" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control">
            <p>{{ $errors->first('title') }}</p>
          </div>

          <div class="form-group">
            <label for="description">Descripcion</label>
            <textarea class="form-control" id="description" name="description"cols="30" rows="10"></textarea>
            <p>{{ $errors->first('description') }}</p>
          </div>

          <div class="form-group">
            <label for="title">Imagen</label>
            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png">
            <p>{{ $errors->first('image') }}</p>
          </div>

          <div class="form-group">
            <label for="title">Video</label>
            <input type="file" class="form-control" id="video" name="video" type="video/mp4">
            <p>{{ $errors->first('description') }}</p>
          </div>
          <button type="submit" class="btn btn-success">video</button>
        </form>

    </div>
</div>
@endsection
