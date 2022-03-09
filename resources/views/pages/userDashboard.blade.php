@extends('layouts.main-layout')
@section('content')

    <h2> Ciao {{Auth::user() -> name }}, benvenuto alla tua dashboard!</h2>

    <?php

        $message_apartment = 0;

        foreach ($apartments as $apartment) {
            foreach ($messages as $message)
                if ($message->apartment_id == $apartment->id) {
                    $message_apartment++;
                }
        }

    ?>

    @foreach ($apartments as $apartment)
        {{-- mostra la lista degli appartamenti che appartengono all'utente --}}
        
        @if ($apartment->user_id == Auth::user()->id)
            <a href="{{route('showApartment', $apartment->id)}}">{{$apartment->title}}</a>

            <a href="{{route('sponsor', $apartment->id)}}" class="bnt btn-primary"> Sponsorizza </a>

            <a href="{{route('viewMessage', $apartment->id)}}" class="bnt btn-primary">Notifiche</a>

            <span>
                {{$message_apartment}}
            </span><br>
    
        @endif
    @endforeach
    <a class="btn btn-primary my-2" href="{{route('apartmentCreate')}}">Crea nuovo appartamento</a>

    
    
@endsection
