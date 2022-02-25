@extends('layouts.main-layout')
@section('content')

    <h1>ricerca avanzata</h1>
    @foreach ($apartments as $apartment)
        <a href="{{route('showApartment', $apartment->id)}}">{{$apartment->title}}</a>
    @endforeach
    
@endsection
