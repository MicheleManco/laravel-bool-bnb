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

<style scoped lang="scss">

    #containerForm  h3{
        font-size:30px;
        padding:15px 0;
        padding-left:15px;
    }

    #containerForm{
        display:flex;
        justify-content: center;
    } 

    input{
        margin:10px 0px;
    }

    #containerForm{
        padding:20px 0px 80px 60px;
    }

    input{
        width:83%;
        height:45px;
        border-radius:50px;
        border:1px solid grey;
    }

    textarea{
        border-radius:13px;
        border:1px solid grey;
        margin-top:10px;
    }

    #button_register{
        color: #FFFFFF;
        font-family: Helvetica;
        font-size: 15px;
        background-color: #FFAE00;
        text-decoration: none;
        cursor: pointer;
        width:120px;
        border: #FFAE00;
        border-radius: 38px;
        margin-top:10px;
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