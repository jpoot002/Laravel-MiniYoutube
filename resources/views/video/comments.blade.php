

 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<h1>fkashdñfñoasd</h1>
@foreach($comments as $commen)
<h5>{{$commen->id}}</h5>
<h5>{{$commen->body}}</h5>
@endforeach
{{$comments->links()}}


