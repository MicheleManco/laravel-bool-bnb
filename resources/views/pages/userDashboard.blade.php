@extends('layouts.main-layout')
@section('content')

    <h2> Ciao {{Auth::user() -> name }}, benvenuto alla tua dashboard!</h2>
    @foreach ($apartments as $apartment)
        @if ($apartment->user_id == Auth::user()->id)
            <a href="{{route('showApartment', $apartment->id)}}">{{$apartment->title}}</a> <br>
        @endif
    @endforeach
    <a href="{{route('apartmentCreate')}}">Crea nuovo appartamento</a>
    
@endsection
