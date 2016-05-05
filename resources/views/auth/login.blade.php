@extends('layouts.master')

@section('content')
  <navbar></navbar>
  <div class="row">
    <div class="medium-8 medium-offset-2 columns">
      <h2>Entrar</h2>
      <form method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}

        <label>Correo Electrónico
          <input type="text" name="email" value="{{ old('email') }}">
        </label>

        @if ($errors->has('email'))
          <p class="help-text">{{ $errors->first('email') }}</p>
        @endif


        <label>Contraseña
          <input type="password" name="password">
        </label>

        @if ($errors->has('password'))
          <p class="help-text">{{ $errors->first('password') }}</p>
        @endif

        <label>Recuérdame
          <input type="checkbox" name="remember">
        </label>

        <button type="submit" class="button">
          <i class="fa fa-sign-in"></i> Entrar
        </button>
      </form>
    </div>
  </div>
  <my-footer></my-footer>
@endsection

