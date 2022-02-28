@extends('layouts.main-layout')
@section('content')

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
        <form action="{{route('apartmentUpdate', $apartment->id)}}" method="POST">
        
            @method('POST')
            @csrf
        
            <label for="title">Titolo</label>
            <input type="text" name="title"  value="{{$apartment->title}}">
            <label for="description">Descrizione</label>
            <input type="text" name="description" value="{{$apartment->description}}">
            <label for="address">Indirizzo</label>
            <input type="text" name="address" value="{{$apartment->address}}">
            <label for="city">Città</label>
            <input type="text" name="city" value="{{$apartment->city}}">
            <label for="cap">CAP</label>
            <input type="text" name="cap" value="{{$apartment->cap}}">
            <label for="sqmeters">Metri quadri</label>
            <input type="number" name="sqmeters" value="{{$apartment->sqmeters}}">
            <label for="rooms">Stanze</label>
            <input type="number" name="rooms" value="{{$apartment->rooms}}">
            <label for="beds">Letti</label>
            <input type="number" name="beds" value="{{$apartment->beds}}">
            <label for="bathrooms">Bagni</label>
            <input type="number" name="bathrooms" value="{{$apartment->bathrooms}}">
            <label for="price">Prezzo a notte</label>
            <input type="number" name="price" value="{{$apartment->price}}">
            <label for="category_id">Categoria</label>
            <select name="category">
                @foreach ($categories as $category)            
                    <option value="{{$category->id}}"
                        @if ($category->id == $apartment->category->id)
                            selected
                        @endif
                        >{{$category->name}}</option>
                @endforeach
            </select><br>
            @foreach ($services as $service)
                <input type="checkbox" value="{{$service->id}}" name="services[]"
                @foreach ($apartment->services as $apartmentService)
                    @if ($service->id == $apartmentService->id)
                        checked
                    @endif
                @endforeach
                >{{$service->name}}<br>
            @endforeach
            
            <input type="submit" value= "Salva modifiche">
        </form>
    @else
        Non sei il  proprietario di questo appartamento.
    @endif
@endauth

    
@endsection
