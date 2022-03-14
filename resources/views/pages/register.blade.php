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

    {{-- form di registrazione --}}
    <div id="containerForm" class="container-fluid">
        <div class="col-12 col-sm-12 col-md-12 col-lg-5">
            <h3>Registrati</h3>
            <form action="{{route('register')}}" method="POST" class="container-fluid">
                @method('POST')
                @csrf
                    <input type="text" name="name" placeholder="  Nome"> 
                    <input type="text" name="surname" placeholder="  Cognome">
                    <input type="email" name="email" placeholder="  Email">
                    <input type="password" name="password" placeholder="  Password">
                    <input type="password" name="password_confirmation" placeholder="  Conferma Password">
                    <input type="text" placeholder="  Data di nascita" onfocus="(this.type='date')">                
                    <textarea name="description" placeholder="Descrivi il tuo appartamento" rows="10" class="col-10 col-sm-10 col-md-10 col-lg-10"></textarea> <br>
                    <input type="submit" value= "Register" id="button_register">
            </form>
        </div>
    </div>
    
@endsection
