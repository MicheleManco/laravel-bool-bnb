@extends('layouts.main-layout')

@section('content')
{{$apartment->title}}
    @foreach ($sponsorship  as $sponsor)
        <p><a href="{{route('sponsorStore', $apartment->id)}}">{{$sponsor->name}}</a>-- {{$sponsor->price}}€</p>
    @endforeach
@endsection