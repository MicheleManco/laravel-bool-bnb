@extends('layouts.main-layout')
@section('content')
    <h2> Ciao {{ Auth::user()->name }}, benvenuto alla tua dashboard!</h2>
    @foreach ($apartments as $apartment)
        {{-- mostra la lista degli appartamenti che appartengono all'utente --}}
        @if ($apartment->user_id == Auth::user()->id)
            <a href="{{ route('showApartment', $apartment->id) }}">{{ $apartment->title }}</a>

            <?php
            $sponsorship = $apartmentSponsorship;
            $isSponsored = false;
            $expired = false;
            
            foreach ($sponsorship as $sponsored) {
                if ($sponsored->apartment_id == $apartment->id) {
                    $isSponsored = true;
                }
                if ($apartment->id == $sponsored->apartment_id && $sponsored->end_date < $dateNow) {
                    $expired = true;
                }
            }
            ?>

            @if ($isSponsored == false || $expired)
                <a href="{{ route('sponsor', $apartment->id) }}" class="bnt btn-primary">Sponsorizza </a>
            @endif
            <br>
        @endif
    @endforeach
    <br>
    <a class="btn btn-primary my-2" href="{{ route('apartmentCreate') }}">Crea nuovo appartamento</a>
@endsection
