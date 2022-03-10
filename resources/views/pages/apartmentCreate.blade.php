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
    <form action="{{route('apartmentStore')}}" enctype="multipart/form-data" method="POST"> 

        @method('POST')
        @csrf
        <div>
            <label for="title">Titolo</label><br>
            <input type="text" name="title"><br>
            <label for="description">Descrizione</label><br>
            <input type="text" name="description"><br>
            <label for="address">Indirizzo</label><br>
            <input type="text" name="address"><br>
            <label for="city">Città</label><br>
            <input type="text" name="city"><br>
            <label for="cap">CAP</label><br>
            <input type="text" name="cap"><br>
            <label for="sqmeters">Metri quadri</label><br>
            <input type="number" name="sqmeters"><br>
        </div>
        <div>
            <label for="rooms">Stanze</label><br>
            <input type="number" name="rooms"><br>
            <label for="beds">Letti</label><br>
            <input type="number" name="beds"><br>
            <label for="bathrooms">Bagni</label><br>
            <input type="number" name="bathrooms"><br>
            <label for="price">Prezzo a notte</label><br>
            <input type="number" name="price"><br>
        </div>
        <div>
            <label for="category_id">Categoria</label><br>
            <select name="category">
                @foreach ($categories as $category)            
                    <option value="{{$category->id}}">{{$category->name}}</option><br>
                @endforeach
            </select><br>
            @foreach ($services as $service)
                <input type="checkbox" value="{{$service->id}}" name="services[]">{{$service->name}}<br>
            @endforeach
            <label for="images">Immagini</label>
            <input type="file" name="images[]" accept="image/*" multiple>
            <input type="submit" value= "Salva nuovo appartamento">
        </div>
    </form>
    
@endsection

<style>
    form{
        display: flex;
        justify-content:center;
    }
</style>
