@extends('layouts.main-layout')

@section('content')
    <div id="sponsorship">
        @foreach ($sponsorship  as $sponsor)
        <a href="{{route('sponsorStore', ['id' => $apartment->id,'sponsor_id' => $sponsor->id])}}" method="post">
            <div class="sponsor {{$sponsor->name}}">
                <img src='/images/{{$sponsor->name}}.png' alt="{{$sponsor->name}}">
                <h1 class="name">{{$sponsor->name}}</h1>
                <span class="info {{$sponsor->name}}"> A soli {{$sponsor->price}}€ <br>
                avrai il tuo sponsor per {{$sponsor->duration/24}} giorni </span>
            </div>
        </a>
        @endforeach
    </div>
@endsection