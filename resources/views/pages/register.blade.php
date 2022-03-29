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
    <div id="containerForm" class="container-fluid col-6 col-sm-4">
        <div>
            <h3>Registrati</h3>
            <form action="{{route('register')}}" method="POST">
                @method('POST')
                @csrf
                    <input type="text" name="name" placeholder="Nome"> <br>
                    <input type="text" name="surname" placeholder="Cognome"><br>
                    <input type="email" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <input type="password" name="password_confirmation" placeholder="Conferma Password"><br>
                    <input type="text" name="birthday" placeholder="Data di nascita" onfocus="(this.type='date')"><br>
                    <textarea name="description" placeholder="Aggiungi una breve descrizione" rows="8" class="col-12 col-sm-4 col-md-4 col-lg-12"></textarea><br>
                    <button type="submit" value= "Register" id="button_below">Registrati   </button>
            </form>
        </div>
    </div>

@endsection