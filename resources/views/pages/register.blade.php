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
    <form class="form" action="{{route('register')}}" method="POST">

        @method('POST')
        @csrf

        <label for="name">Nome</label>
        <input type="text" name="name">
        <label for="surname">Cognome</label>
        <input type="text" name="surname">
        <label for="email">Email</label>
        <input type="email" name="email">
        <label for="password">Password</label>
        <input type="password" name="password">
        <label for="password_confirmation">Password-confirmation</label>
        <input type="password" name="password_confirmation">
        <label for="birthday">Data di nascita</label>
        <input type="date" name="birthday">
        <label for="description">Descrizione</label>
        <input type="textarea" name="description">

        <input class='my-4 btn btn-primary' type="submit" value= "Register">
    </form>
    
@endsection