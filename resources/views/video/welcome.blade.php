

@extends('layouts.app')
<link href="{{ URL::asset('css/welcome_video.css') }}" rel="stylesheet">
@section('content')
@if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <button class="close" data-dismiss="alert" ><span aria-hidden="true">&times;</span> </button>
        </div>
    @endif
<div class="containerprincipal  ">

    <div class=" containerwe ">
        <div class="card-columns rowhome ">
        @foreach($videos as $video)
           <div class="card  ">
                <div class="row ">
                    <div class="col padding">
                        @if(Storage::disk('Images')->has($video->image))
                        <img class="card-img-top img" alt="{{ $video->image }}" src="{{ route('imageVideo',$video->image) }}"alt="Card image cap">
                        @endif
                        <div class="card-body">
                          <h5 class="card-title">{{ $video->title }}</h5>
                          <p class="card-text">{{ \FormatTime::LongTimeFilter($video->created_at) }}</p>
                          <a href="{{ route('editVideo',$video->id) }}" class="btn btn-primary">Editar</a>
                          <a href="{{ route('Vervideo',$video->id) }}" class="btn btn-secondary">vista publico</a>
                          <a href="#Modalvideo{{$video->id}}" role="button" class="btn  btn-danger" data-toggle="modal">Eliminar</a>
                            <div id="Modalvideo{{$video->id}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                         <h4>¿Seguro que quieres borrar este video?</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                             <p>{{$video->title}}</p>
                                        </div>
                                        <div class="modal-footer">
                                             <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                             <form method="POST" action="{{route('Eliminarvideo')}}" nctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" type="text" name="video_path" value="{{$video->video_path}}">
                                                <input type="hidden" type="text" name="imagen" value="{{$video->image}}">
                                                <input type="hidden" type="number" name="id" value="{{$video->id}}">
                                                <button style="button" type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col ">
                        <h4>comentario</h4>
                        <div class=" col-md-auto">
                            <ul class="anyClass padding">
                                @if(isset($video->Comments))
                                    @foreach($video->Comments as $Comment)
                                        <div class="card widget-flat padding">
                                            <div class="card-body">
                                                <h4>Realizado por {{$Comment->user->name}}</h4>
                                                <p> {{ \FormatTime::LongTimeFilter($Comment->created_at) }}</p>
                                                <h5>{{$Comment->body}}</h5>
                                                <!--(lanza el modal en Bootstrap) -->
                                                <a href="#ModalComentarios{{$Comment->id}}" role="button" class="btn btn-sm btn-danger" data-toggle="modal">Eliminar</a>
                                                 <!-- Modal / Ventana / Overlay en HTML -->
                                                <div id="ModalComentarios{{$Comment->id}}" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                             <h4>¿Seguro que quieres borrar este comentario?</h4>
                                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                 <p>{{$Comment->body}}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                 <form method="POST" action="{{route('Eliminarcomentario')}}" nctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" type="number" name="id" value="{{$Comment->id}}">
                                                                    <button style="button" type="submit" class="btn btn-danger">Eliminar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    {{$videos->links()}}
    </div>

</div>
@endsection
