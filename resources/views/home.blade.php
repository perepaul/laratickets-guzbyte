@extends('layouts.app')

@section('content')


<main class="container" style="background: #f7f7f7">
    <div class="bg-light p-5 rounded mt-3">
      <h1>Welcome to {{ env("APP_NAME") }}</h1>
      <p class="lead">{{ __('You are logged as '.auth()->user()->role)."!" }}</p>

      <a class="btn btn-lg btn-primary" href="{{ url(roleUrl(auth()->user()->role)) }}" role="button">Goto Dashboard &raquo;</a>
    </div>
</main>

@endsection
