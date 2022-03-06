@extends('layouts.main-layout')

@section('content')
    <div id="sponsorship">
        @foreach ($sponsorship  as $sponsor)
        <a href="{{route('sponsorStore', ['id' => $apartment->id,'sponsor_id' => $sponsor->id])}}" method="post">
            <div class="sponsor {{$sponsor->name}}">
                <h1 class="name">{{$sponsor->name}}</h1>
                <span class="price"> A soli {{$sponsor->price}}€ <br>
                avrai il tuo sponsor per {{$sponsor->duration/24}} giorni </span>


            </div>
        </a>
        @endforeach
    </div>
    

    <?php


        $Date1 = Carbon\Carbon::now(); 
        $date = new DateTime($Date1); 
        $date->modify('+ 1 day'); 
        $Date2 = $date->format('Y-m-d // h:i:s');

        echo $Date1, $Date2;
    ?>
@endsection