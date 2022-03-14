@extends('layouts.main-layout')
@section('content')
    <section id="user-dashboard">
        {{-- <a href="/">Torna indietro</a> --}}
        <div class="dash-head">
            <div>
                <h2> Benvenuto {{ Auth::user()->name }}!</h2>
                <h2>Questa è la tua dashboard!</h2>
            </div>
            <a class="my-btn" href="{{ route('apartmentCreate') }}">Crea nuovo appartamento</a>
        </div>

        <hr>
        
        <div class="dash-ap-list">
            @foreach ($apartments as $apartment)
                {{-- mostra la lista degli appartamenti che appartengono all'utente --}}
            
                @if ($apartment->user_id == Auth::user()->id)
                    <div class="apartment col-sm-12 col-lg-8 col-xl-6">
                        
                        <div class="apartment-head">
                            <a href="{{ route('showApartment', $apartment->id) }}" class="aparment-title">{{ $apartment->title }}</a>

                            <div>
                                <span>Messaggi: </span>
                                <a href="{{route('viewMessage', $apartment->id)}}" class="my-btn">
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
                                </a>
                            </div>
                        </div>
                        <div class="apartment-foot">
                            <div class="apartment-sponsor">
                                <?php
                                $sponsorship = $apartmentSponsorship;
                                $isSponsored = false;
                                $expired = false;
                                foreach ($sponsorship as $sponsored) {
                                    if ($sponsored->apartment_id == $apartment->id) {
                                        $isSponsored = true;
                                    }
                                    if ($apartment->id == $sponsored->apartment_id && $sponsored->end_date < $dateNow) {
                                        $expired = true;
                                    }
                                }
                                ?>
                                @if ($isSponsored == false || $expired)
                                <a href="{{ route('sponsor', $apartment->id) }}" class="my-btn sponsor-btn d-md-none"><i class="fas fa-ad"></i></a>
                                    <a href="{{ route('sponsor', $apartment->id) }}" class="my-btn sponsor-btn d-none d-md-inline">Sponsorizza </a>
                                @else
                                    <span class="my-btn btn-outline btn-sponsored d-none d-md-inline">Già sponsorizzato</span>
                                    <i class="fas fa-ban my-btn btn-sponsored btn-outline d-md-none "></i>
                                @endif
                            </div>
                            <div class="aparment-edit-delete">
                                <a href="{{route('apartmentEdit', $apartment->id)}}" class="my-btn btn-outline">Modifica</a>
                                <a href="{{route('apartmentDelete', $apartment->id)}}" class="my-btn btn-outline">Elimina</a>    
                                <a href="{{route('apartmentStatistics', $apartment->id)}}" class="my-btn btn-outline">Statistiche</a> 
                            </div>
                        </div>
            

                    </div>
            
                @endif
            @endforeach
        </div>
    </section>
@endsection
