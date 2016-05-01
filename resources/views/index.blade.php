@extends('layouts.master')

@section('content')
  <greeter></greeter>
@endsection

@section('js')
  <script src="{{ asset('js/app.js') }}"></script>
@endsection
