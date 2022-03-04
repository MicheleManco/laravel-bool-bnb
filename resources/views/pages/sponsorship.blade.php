@extends('layouts.main-layout')

@section('content')
{{$apartment->title}}
    @foreach ($sponsorship  as $sponsor)
        <p><a href="{{route('sponsorStore', $apartment->id)}}">{{$sponsor->name}}</a>-- {{$sponsor->price}}€</p>
    @endforeach

    <?php

        // $startDate = "";
        // $addDate = 2;
        // $endDate = "";
        

        //  function getDateNow() {
        //     $startDate = Carbon\Carbon::now();

        //     $endDate = date_add($startDate, date_interval_create_from_date_string("1 day"));

        //     echo $startDate->toDateTimeString();
        //     echo $endDate->toDateTimeString();
            
        // }

        // getDateNow();

        $Date1 = Carbon\Carbon::now(); 
        $date = new DateTime($Date1); 
        $date->modify('+ 1 day'); 
        $Date2 = $date->format('Y-m-d // h:i:s');

        echo $Date1, $Date2;
    ?>

    






    {{-- <form  action="{{route('sponsorStore', $apartment->id)}}"  method="post">  
        @method('POST') 
        @csrf   
        
        <label for="start_date">start_Date</label>
        <input type="datetime-local" name="start_date" value="test"><br>
        <label for="end_date">end_Date</label>  
        <input type="datetime-local" name="end_date" value="test"><br>

        <input type="submit" value="CREATE" class="btn btn-primary">  
    </form> --}}
@endsection