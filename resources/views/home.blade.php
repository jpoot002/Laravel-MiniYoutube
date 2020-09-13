@extends('layouts.app')
<link href="{{ URL::asset('css/home.css') }}" rel="stylesheet">
@if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <button class="close" data-dismiss="alert" ><span aria-hidden="true">&times;</span> </button>
        </div>
    @endif
@section('content')
<div class="containerprincipal  ">
    <div class="containerwe" >

        <div class="card-columns rowhome ">
        @foreach($videos as $video)
          <div class="card color ">
                @if(Storage::disk('Images')->has($video->image))
                <a href="{{ route('Vervideo',$video->id) }}"> <img class="card-img-top img" alt="{{ $video->image }}" src="{{ route('imageVideo',$video->image) }}"alt="Card image cap"></a>
                @endif
              <div class="card-body ">
                <h4 class="card-title a">{{ $video->title }}</h4>
                <p class="card-text"><small class="text-muted">creado por {{ $video->user->name }} / {{ \FormatTime::LongTimeFilter($video->created_at) }}</small></p>
              </div>
            </div>
            @endforeach
        </div>
    {{$videos->links()}}
    </div>
</div>

@endsection
