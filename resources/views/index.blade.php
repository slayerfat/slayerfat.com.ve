@extends('layouts.master')

@section('css')
  <style>
    .greeter {
      background-image: url({{ asset($background) }});
    }
  </style>
@endsection

@section('content')
  <router-view></router-view>
@endsection
