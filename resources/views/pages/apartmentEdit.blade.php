@extends('layouts.main-layout')
@section('content')

<div id="apartment-edit">
    @auth
    {{-- se l'utente è il proprietario dell'appartamento c'è la possibilità di modificarlo o eliminarlo --}}
        @if (Auth::user()->id == $apartment->user_id)
            {{-- mostra eventuali errori nella validazione dei dati --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            {{-- form di modifica dell'appartamento --}}
            <form action="{{route('apartmentUpdate', $apartment->id)}}" enctype="multipart/form-data" method="POST" class="container-fluid">
    
                @method('POST')
                @csrf

                <div class="col-10 col-sm-10 col-md-5 col-offset-2 offset-1 col-lg-5 container-fluid input-cont">
                    <input type="text" name="title" value="{{$apartment->title}}" placeholder="Titolo"><br>
                    <textarea name="description"  rows="10" class="col-10 col-sm-10 col-md-10 col-lg-10" value="{{$apartment->description}}">{{$apartment->description}}</textarea><br>
                    <input type="number" name="sqmeters" value="{{$apartment->sqmeters}}" placeholder="Metri quadri"><br>            
                    <input type="number" name="rooms" value="{{$apartment->rooms}}" placeholder="Stanze"><br>
                    <input type="number" name="beds" value="{{$apartment->beds}}" placeholder="Letti"><br>
                    <input type="number" name="bathrooms" value="{{$apartment->bathrooms}}" placeholder="Bagni"><br>
                </div>
                
                <div class="col-10 col-sm-10 col-md-5 col-lg-5 container-fluid">
                    <div class="input-cont">
                        <input type="text" name="address" value="{{$apartment->address}}" placeholder="Indirizzo"><br>
                        <input type="text" name="city" value="{{$apartment->city}}" placeholder="Città"><br>
                        <input type="text" name="cap" value="{{$apartment->cap}}" placeholder="CAP"><br>
                        <input type="number" name="price" value="{{$apartment->price}}" placeholder="Prezzo a notte"><br>
                    </div>
    
                    <div id="checkbox">
                        <select id="category" class="col-10 col-sm-10 col-md-10 col-lg-10" name="category">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if ($category->id == $apartment->category->id)
                                        selected
                                    @endif
                                    >{{$category->name}}</option>
                            @endforeach
                        </select><br>
                        <div id="category_div">
                            @foreach ($services as $service)
                                <li><input type="checkbox" value="{{$service->id}}" name="services[]" @foreach ($apartment->services as $apartmentService) @if ($service->id == $apartmentService->id) checked @endif @endforeach>  {{$service->name}}</li> 
                            @endforeach
                        </div>
                        <label for="images">Immagini</label>
                        <input type="file" name="images[]" accept="image/*" multiple><br>
                        <button id="create_button" type="submit" value= "Salva nuovo appartamento" > Salva nuovo appartamento </button>
                    </div>
                </div>
            </form>
        @else
            Non sei il  proprietario di questo appartamento.
        @endif
    @endauth
</div>

    
@endsection
