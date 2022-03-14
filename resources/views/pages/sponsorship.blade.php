@extends('layouts.main-layout')

@section('content')
    <div id="sponsorship">
        <div class="title">
            <h2>Sponsorizza il tuo appartamento</h2>
            <p>Sponsorizzandolo, il tuo appartamento apparirà in home page.</p>
        </div>
        <div class="ap-info">
            <h3>
                {{$apartment->title}}
            </h3>
            <h4>
                {{$apartment->address}} {{$apartment->city}} {{$apartment->cap}}
            </h4>
        </div>
        <div class="sponsor-tiers d.flex flex-sm-wrap flex-lg-nowrap">
            @foreach ($sponsorship  as $sponsor)
            <div class="col-sm-10 col-lg-4 mx-sm-auto mb-sm-5 mb-lg-0">
                <a href="{{route('sponsorStore', ['id' => $apartment->id,'sponsor_id' => $sponsor->id])}}" method="post">
                    <div class="sponsor {{$sponsor->name}}">
                        <img src='/images/{{$sponsor->name}}.png' alt="{{$sponsor->name}}">
                        <h3 class="name">{{$sponsor->name}}</h3>
                        <p class="info"> A soli <span class="price">{{$sponsor->price}} €</span> l'appartmento sarà sponsorizzato per {{$sponsor->duration/24}} giorni </p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection