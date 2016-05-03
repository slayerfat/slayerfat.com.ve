@extends('layouts.master')

@section('content')
  <videos></videos>
@endsection

@section('js')
  <script>
    setTimeout(function () {
      $(".lazy-img").lazyload();
    }, 2000);
  </script>
@stop

