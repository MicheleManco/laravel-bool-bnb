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
        <form action="{{route('register')}}" method="POST" class="container-fluid">

            @method('POST')
            @csrf
            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                <label for="name">Nome</label><br>
                <input type="text" name="name"> <br>
                <label for="surname">Cognome</label><br>
                <input type="text" name="surname"><br>
                <label for="email">Email</label><br>
                <input type="email" name="email"><br>
                <label for="password">Password</label><br>
                <input type="password" name="password"><br>
            </div>
            <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                <label for="password_confirmation">Password-confirmation</label><br>
                <input type="password" name="password_confirmation"><br>
                <label for="birthday">Data di nascita</label><br>
                <input type="date" name="birthday"><br>
                <label for="description">Descrizione</label><br>
                <input type="textarea" name="description"><br>
                <input type="submit" value= "Register" id="button_register">
            </div>
        </form>
    </div>
    
@endsection

<style scoped lang="scss">

    form{
        display:flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    #containerForm{
        padding:40px 0 60px;
    }

    label{
        display: inline-block;
        font-size:18px;
        margin-top:15px;
    }

    input{
        width:80%;
        height:45px;
        border-radius:50px;
        box-shadow: 1px 5px 10px #332b27;
        border:1px solid #332b27;
    }

    #button_register{
        color: #FFFFFF;
        font-family: Helvetica;
        font-size: 15px;
        background-color: #FFAE00;
        text-decoration: none;
        cursor: pointer;
        width:90px;
        border: #FFAE00;
        border-radius: 38px;
        margin-top:45px;
        font-weight:600;
    }

    #button_register:hover {
        border: solid #FFAE00;
        text-decoration: none;
        background-color: #332b27;
        transform: translate(0, 0);
        -ms-transform: translate(-50%, -50%);
   }

</style>