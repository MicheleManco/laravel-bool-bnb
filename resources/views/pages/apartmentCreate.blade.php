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
    <form action="{{route('apartmentStore')}}" enctype="multipart/form-data" method="POST"  class="container-fluid"> 

        @method('POST')
        @csrf
        <div id="first" class="col-10 col-sm-5 col-md-5 col-lg-5">
            <input type="text" name="title" placeholder="  Titolo"><br>
            <textarea name="description" placeholder="  Descrizione" rows="10" class="col-10 col-sm-10 col-md-10 col-lg-10"></textarea><br>
            <input type="number" name="sqmeters" placeholder="  Metri quadri"><br>            
            <input type="number" name="rooms" placeholder="  Stanze"><br>
            <input type="number" name="beds" placeholder="  Letti"><br>
            <input type="number" name="bathrooms" placeholder="  Bagni"><br>
        </div>

        <div class="col-10 col-sm-5 col-md-5 col-lg-5">
            <div id="second">
                <input type="text" name="address" placeholder="  Indirizzo"><br>
                <input type="text" name="city" placeholder="  Città"><br>
                <input type="text" name="cap" placeholder="  Cap"><br>
                <input type="number" name="price" placeholder="  Prezzo"><br>
            </div>

            <div id="checkbox">
                <label for="category_id">Categoria</label><br>
                <select name="category">
                    @foreach ($categories as $category)            
                        <option value="{{$category->id}}">{{$category->name}}</option><br>
                    @endforeach
                </select><br>
                <div id="list_button">
                    @foreach ($services as $service)
                        <div id="check_bob_mini"><input type="checkbox"  value="{{$service->id}}" name="services[]">{{$service->name}}</div>
                    @endforeach
                </div>
                <label for="images">Immagini</label>
                <input type="file" name="images[]" accept="image/*" multiple> <br>
                <input type="submit" value= "Salva nuovo appartamento">
            </div>
        </div>
    </form>
    
@endsection

<style>
    form{
        display:flex;
        flex-direction:row;
        justify-content:center;
    }

    #first input{
        width:84%;
        border-radius:35px;
        border:1px solid grey;
        margin:10px 0;
        height:40px;
        padding-right:20px;
    }

    #second input{
        width:84%;
        border-radius:35px;
        border:1px solid grey;
        margin:10px 0;
        height:40px;
        padding-right:20px;
    }

    textarea{
        border-radius:10px;
        border:1px solid grey;
    }

    #checkbox{
        width:40%;
    }

    #check_bob_mini{
        padding:5px;
    }

</style>
