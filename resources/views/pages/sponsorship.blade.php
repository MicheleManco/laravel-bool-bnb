@extends('layouts.main-layout')

@section('content')
{{$apartment->title}}
    @foreach ($sponsorship  as $sponsor)
        <p>
            <a href="{{route('sponsorStore', ['id' => $apartment->id,'sponsor_id' => $sponsor->id])}}" method="post">
             {{$sponsor->name}}
             {{$sponsor->id}}
            </a>-- {{$sponsor->price}}€
        </p>
    @endforeach

    <?php


        $Date1 = Carbon\Carbon::now(); 
        $date = new DateTime($Date1); 
        $date->modify('+ 1 day'); 
        $Date2 = $date->format('Y-m-d // h:i:s');

        echo $Date1, $Date2;
    ?>
@endsection