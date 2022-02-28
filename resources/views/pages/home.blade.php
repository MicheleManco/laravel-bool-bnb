@extends('layouts.main-layout')
@section('content')

<a href="{{route('search')}}">Cerca</a>

<div id="elenco">

  @if ($apartments ==! 0)  

    @foreach ($apartments as $apartment)
        <div id="apartment">
            <a href="{{route('showApartment', $apartment->id)}}">{{$apartment->title}}</a>
        </div>
    @endforeach

    @else

    <div id="null">
        <h1>Non ci sono appartamenti</h1>
    </div>

    @endif

</div>
@endsection
