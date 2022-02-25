@extends('layouts.main-layout')
@section('content')

    <h1>{{$apartment->title}}</h1>
    <p>{{$apartment->description}}</p>
    
    @auth
        @if (Auth::user()->id == $apartment->user_id)
            <a href="{{route('apartmentEdit', $apartment->id)}}">Modifica</a>
            <a href="{{route('apartmentDelete', $apartment->id)}}">Elimina</a>            
        @endif
    @endauth

@endsection
