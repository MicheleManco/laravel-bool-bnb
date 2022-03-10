@extends('layouts.main-layout')
@section('content')

   

    <?php

    foreach ($stats as $stat) {
        if ($stat->apartment_id == $apartment->id) {
            $stat->id;
        }
    }
    ?>

    <a href="{{route('home')}}">Torna indietro</a>

    {{-- pagina di dettaglio dell'appartamento --}}
    <h1>{{$apartment->title}}</h1>
    <h4>{{$apartment->city}}, <small>{{$apartment->address}}</small></h4>
    <p>{{$apartment->description}}</p>
    <span>Prezzo a notte: {{$apartment->price}}€</span>
    <p>{{$apartment->views}}</p>

    {{-- Component per mappa --}}
    <map-component 
    latitude="{{$apartment->latitude}}"
    longitude="{{$apartment->longitude}}"
    ></map-component>

    {{-- form per i messaggi --}}
    <form action="{{route('messagesPost', $apartment->id)}}" method='POST'>
        @method('POST')
        @csrf

        <label for="name">Nome:</label> <br>
        <input type="text" name="name"><br>
        <label for="surname">Cognome</label><br>
        <input type="text" name="surname"><br>
        <label for="email">Email</label><br>
        <input type="email" name="email"><br>
        <label for="text">Testo</label><br>
        <textarea name="text" cols="50"></textarea><br>
        <input type="submit" value="manda">

    </form>
    
    @auth
        {{-- se l'utente è il proprietario dell'appartamento c'è la possibilità di modificarlo o eliminarlo --}}
        @if (Auth::user()->id == $apartment->user_id)
            <a href="{{route('apartmentEdit', $apartment->id)}}">Modifica</a>
            <a href="{{route('apartmentDelete', $apartment->id)}}">Elimina</a>    
            <a href="{{route('apartmentStatistics', ['apartment_id' => $apartment->id,'stat_id' => $stat->id])}}">Statistiche</a> 

        @endif
    @endauth


@endsection
