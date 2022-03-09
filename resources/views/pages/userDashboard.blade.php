@extends('layouts.main-layout')
@section('content')

    


    <h2> Ciao {{Auth::user() -> name }}, benvenuto alla tua dashboard!</h2>

    @foreach ($apartments as $apartment)
        {{-- mostra la lista degli appartamenti che appartengono all'utente --}}
        
        @if ($apartment->user_id == Auth::user()->id)
            <a href="{{route('showApartment', $apartment->id)}}">{{$apartment->title}}</a>

            <a href="{{route('sponsor', $apartment->id)}}" class="bnt btn-primary mx-2"> Sponsorizza </a>

            <a href="{{route('viewMessage', $apartment->id)}}" class="bnt btn-primary">Notifiche</a>

            <span class="border rounded-circle px-2 py-1 mx-2 bg-danger text-white">

                <?php

                    $n_message = 0;

                ?>
                @foreach ($messages as $message)

                    

                    @if ($message->apartment_id == $apartment->id)

                        <?php

                            $n_message++;

                        ?>

                    @endif
                    
                @endforeach
                {{$n_message}}
                

                
            </span><br><br>
    
        @endif
    @endforeach
    <a class="btn btn-primary my-2" href="{{route('apartmentCreate')}}">Crea nuovo appartamento</a>

    
    
@endsection
