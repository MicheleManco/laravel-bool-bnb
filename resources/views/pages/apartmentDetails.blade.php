@extends('layouts.main-layout')
@section('content')

    <h1>{{$apartment->title}}</h1>
    <p>{{$apartment->description}}</p>
    
    @auth
        <a href="{{route('apartmentEdit', $apartment->id)}}">Modifica</a>
        <a href="#">Elimina</a>
    @endauth

@endsection
