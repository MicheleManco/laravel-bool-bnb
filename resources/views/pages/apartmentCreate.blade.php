@extends('layouts.main-layout')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- form per creare un appartamento --}}
    <form action="{{route('apartmentStore')}}" method="POST">

        @method('POST')
        @csrf

        <label for="title">Titolo</label>
        <input type="text" name="title">
        <label for="description">Descrizione</label>
        <input type="text" name="description">
        <label for="address">Indirizzo</label>
        <input type="text" name="address">
        <label for="city">Città</label>
        <input type="text" name="city">
        <label for="cap">CAP</label>
        <input type="text" name="cap">
        <label for="sqmeters">Metri quadri</label>
        <input type="number" name="sqmeters">
        <label for="rooms">Stanze</label>
        <input type="number" name="rooms">
        <label for="beds">Letti</label>
        <input type="number" name="beds">
        <label for="bathrooms">Bagni</label>
        <input type="number" name="bathrooms">
        <label for="price">Prezzo a notte</label>
        <input type="number" name="price">
        <label for="category_id">Categoria</label>
        <select name="category">
            @foreach ($categories as $category)            
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select><br>
        @foreach ($services as $service)
            <input type="checkbox" value="{{$service->id}}" name="services[]">{{$service->name}}<br>
        @endforeach
        
        <input type="submit" value= "Salva nuovo appartamento">
    </form>
    
@endsection
