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

    {{-- form di login --}}
    <div id="containerForm">
        <form action="{{route('login')}}" method="POST">

            @method('POST')
            @csrf

            <label for="email">Email</label><br>
            <input type="email" name="email"> <br>

            <label for="password">Password</label><br>
            <input type="password" name="password" > <br>

            <input id='button_register' type="submit" value="Login">
        </form>
    </div>
    
@endsection

<style scoped lang="scss">

    #containerForm{
        display:flex;
        justify-content:center;
        align-items:center;        
        height:50vh;
    }

    label{
        display: inline-block;
        font-size:18px;
        margin-top:15px;
    }

     input{
        box-shadow: 5px 10px 10px #332b27;
        border:1px solid #332b27;
        border-radius:50px;
    }

    #button_register{
        color: #FFFFFF;
        font-family: Helvetica;
        font-size: 15px;
        background-color: #FFAE00;
        text-decoration: none;
        cursor: pointer;
        padding:10px 15px;
        border: #FFAE00;
        border-radius: 38px;
        font-weight:600;
        line-height:5px;
        margin-top:15px;
    }

    #button_register:hover {
        border: solid #FFAE00;
        text-decoration: none;
        background-color: #332b27;
        transform: translate(0, 0);
        -ms-transform: translate(-50%, -50%);
   }

</style>