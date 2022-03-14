@extends('layouts.main-layout')
@section('content')

    <div id="apartment-create">
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

        <form action="{{route('apartmentStore')}}" enctype="multipart/form-data" method="POST"  class="container-fluid"> 

            @method('POST')
            @csrf
            <div class="col-10 col-sm-10 col-md-5 col-offset-2 offset-1 col-lg-5 container-fluid input-cont">
                <input type="text" name="title" placeholder="Titolo"><br>
                <textarea name="description" placeholder="Descrizione" rows="10" class="col-10 col-sm-10 col-md-10 col-lg-10"></textarea><br>
                <input type="number" name="sqmeters" placeholder="Metri quadri"><br>            
                <input type="number" name="rooms" placeholder="Stanze"><br>
                <input type="number" name="beds" placeholder="Letti"><br>
                <input type="number" name="bathrooms" placeholder="Bagni"><br>
            </div>

            <div class="col-10 col-sm-10 col-md-5 col-lg-5 container-fluid">
                <div class="input-cont">
                    <input type="text" name="address" placeholder="Indirizzo"><br>
                    <input type="text" name="city" placeholder="Città"><br>
                    <input type="text" name="cap" placeholder="CAP"><br>
                    <input type="number" name="price" placeholder="Prezzo a notte"><br>
                </div>

                <div id="checkbox">
                    <select id="category" class="col-10 col-sm-10 col-md-10 col-lg-10" name="category">
                        @foreach ($categories as $category)            
                            <option value="{{$category->id}}">{{$category->name}}</option><br>
                        @endforeach
                    </select><br>
                    <div id="category_div">
                        @foreach ($services as $service)
                        <li><input type="checkbox" value="{{$service->id}}" name="services[]">  {{$service->name}}</li> 
                        @endforeach
                    </div>
                    <label for="images">Immagini</label>
                    <input type="file" name="images[]" accept="image/*" multiple><br>
                    <button id="create_button" type="submit" value= "Salva nuovo appartamento" > Salva nuovo appartamento </button>
                </div>
            </div>
        </form>     
    </div>
@endsection
