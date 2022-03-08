@extends('layouts.main-layout')
@section('content')

    <h2> Ciao {{Auth::user() -> name }}, benvenuto alla tua dashboard!</h2>
    @foreach ($apartments as $apartment)
        {{-- mostra la lista degli appartamenti che appartengono all'utente --}}
        
        @if ($apartment->user_id == Auth::user()->id)
            <a href="{{route('showApartment', $apartment->id)}}">{{$apartment->title}}</a>

            <a href="{{route('sponsor', $apartment->id)}}" class="bnt btn-primary"> Sponsorizza </a><br>
    
        @endif
    @endforeach
    <br><br><br><br>
    <a class="btn btn-primary my-2" href="{{route('apartmentCreate')}}">Crea nuovo appartamento</a>
    
@endsection
