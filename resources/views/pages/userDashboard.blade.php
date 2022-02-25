@extends('layouts.main-layout')
@section('content')

    <h2> Ciao {{Auth::user() -> name }}, benvenuto alla tua dashboard!</h2>
    <a href="#">Crea nuovo appartamento</a>
    
@endsection
