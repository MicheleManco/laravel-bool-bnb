@extends('layouts.main-layout')
@section('content')

    <a href="{{route('home')}}">Torna indietro</a>

    {{-- pagina di dettaglio dell'appartamento --}}
    <h1>{{$apartment->title}}</h1>
    <p>{{$apartment->description}}</p>
    <span>Prezzo a notte: {{$apartment->price}}€</span>

    {{-- Component per mappa --}}
    <map-component 
    address="{{$apartment->address}}"
    city="{{$apartment->city}}"
    cap="{{$apartment->cap}}"
    ></map-component>
    
    @auth
        {{-- se l'utente è il proprietario dell'appartamento c'è la possibilità di modificarlo o eliminarlo --}}
        @if (Auth::user()->id == $apartment->user_id)
            <a href="{{route('apartmentEdit', $apartment->id)}}">Modifica</a>
            <a href="{{route('apartmentDelete', $apartment->id)}}">Elimina</a>            
        @endif
    @endauth

@endsection
