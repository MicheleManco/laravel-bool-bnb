@extends('layouts.main-layout')
@section('content')
<div id="apartment-details">
    <div class="user-controls">
        @auth
            {{-- se l'utente è il proprietario dell'appartamento c'è la possibilità di modificarlo o eliminarlo --}}
            @if (Auth::user()->id == $apartment->user_id)
                <a href="{{route('apartmentEdit', $apartment->id)}}" class="my-btn btn-outline">Modifica</a>
                <a href="{{route('apartmentDelete', $apartment->id)}}" class="my-btn btn-outline">Elimina</a>
                <a href="{{route('apartmentStatistics', $apartment->id)}}" class="my-btn btn-outline">Statistiche</a>
            @endif
        @endauth
    </div>
    
    {{-- pagina di dettaglio dell'appartamento --}}
    <div class="apartment-header">
        <h1>{{$apartment->title}}</h1>
        <div>
            <h4>{{$apartment->city}}, <small>{{$apartment->address}}</small></h4>
            <h4>{{$apartment->price}} € a notte</h4>
        </div>
    </div>
    <div class="img-container">
        <div class="cover-image">
            <img src="/images/apartment-placeholder.jpg" alt="">
        </div>
        <div class="side1">
            <div class="side-img">
                <img src="/images/apartment-placeholder.jpg" alt="">
            </div>
            <div class="side-img">
                <img src="/images/apartment-placeholder.jpg" alt="">
            </div>
        </div>
        <div class="side2">
            <div class="side-img">
                <img src="/images/apartment-placeholder.jpg" alt="">
            </div>
            <div class="side-img">
                <img src="/images/apartment-placeholder.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="apartment-description">

        <div class="text">
            <h3>{{$apartment->category->name}}</h3>
            <div class="ap-numbers">
                <h5>{{$apartment->rooms}} Stanze</h5>
                <h5>{{$apartment->beds}} Letti</h5>
                <h5>{{$apartment->bathrooms}} Bagni</h5>
            </div>
            <p>{{$apartment->description}}</p>
        </div>
        <div class="services">
            @foreach ($services as $service)
            @foreach ($apartment->services as $apartmentService)
                    @if ($service->id == $apartmentService->id)
                        <h6>{{$service->name}}</h6>
                    @endif
                @endforeach
            @endforeach

        </div>
        {{-- <p>{{$apartment->views}}</p> --}}
    </div>

    {{-- Component per mappa --}}
    <map-component
    latitude="{{$apartment->latitude}}"
    longitude="{{$apartment->longitude}}"
    ></map-component>

    <div class="msg-container">
        <h4>Contatta il proprietario</h4>
        {{-- form per i messaggi --}}
        <form action="{{route('messagesPost', $apartment->id)}}" method='POST'>
            @method('POST')
            @csrf
            <input type="text" name="name" placeholder="Nome"><br>
            <input type="text" name="surname" placeholder="Cognome"><br>
            <input type="email" name="email" placeholder="Email"><br>
            <textarea name="text" cols="50" rows="10" placeholder="Scrivi il tuo messaggio."></textarea><br>
            <input type="submit" value="Invia" class="my-btn">
        </form>
    </div>
    
        
</div>


@endsection
