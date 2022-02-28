@extends('layouts.main-layout')
@section('content')

<a href="{{route('search')}}">Fai una ricerca avanzata</a><br>

<p>Insersci la città</p>
<div id="search">
    <input type="search" id="search" name="search" class="txt" size="90%" placeholder="Inserisci città">
    <a href="#"><i class="fas fa-search fs-2"></i></a>
</div>


<div id="elenco">

  @if ($apartments ==! 0)  

    @foreach ($apartments as $apartment)
        <div id="apartment">
            <a href="{{route('showApartment', $apartment->id)}}">{{$apartment->title}}</a>
        </div>
    @endforeach

    @else

    <div id="null">
        <h1>Non ci sono appartamenti sponsorizzati</h1>
    </div>

    @endif

</div>
@endsection
