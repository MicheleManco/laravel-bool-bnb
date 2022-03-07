@extends('layouts.main-layout')
@section('content')

    <a href="{{route('home')}}">Torna indietro</a>

    {{-- pagina di dettaglio dell'appartamento --}}
    <h1>{{$apartment->title}}</h1>
    <h4>{{$apartment->city}}, <small>{{$apartment->address}}</small></h4>
    <p>{{$apartment->description}}</p>
    <span>Prezzo a notte: {{$apartment->price}}€</span>

    {{-- Component per mappa --}}
    <map-component 
    address="{{$apartment->address}}"
    city="{{$apartment->city}}"
    cap="{{$apartment->cap}}"
    ></map-component>

    {{-- form per i messaggi --}}
    <form action="#">

        <label for="name">Nome:</label> <br>
        <input type="text" name="name"><br>
        <label for="surname">Cognome</label><br>
        <input type="text" name="surname"><br>
        <label for="email">Email</label><br>
        <input type="email" name="email"><br>
        <label for="text">Testo</label><br>
        <textarea name="text" cols="50"></textarea><br>

    </form>
    
    @auth
        {{-- se l'utente è il proprietario dell'appartamento c'è la possibilità di modificarlo o eliminarlo --}}
        @if (Auth::user()->id == $apartment->user_id)
            <a href="{{route('apartmentEdit', $apartment->id)}}">Modifica</a>
            <a href="{{route('apartmentDelete', $apartment->id)}}">Elimina</a>            
        @endif
    @endauth

@endsection
