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
    <div id="containerForm" class="col-12 col-sm-12 col-md-12 col-lg-12">
        <form action="{{route('login')}}" method="POST">

            @method('POST')
            @csrf

            <input type="email" name="email" placeholder="  Email"> <br>
            <input type="password" name="password" placeholder="  Password"> <br>
            <button id='button_register' type="submit" value="Login">LOGIN</button>
        </form>
    </div>
    
@endsection

<style scoped lang="scss">

    form input{
        margin-top:15px;
        border-radius:50px;
        border:1px solid grey;
        height:45px;
        width: 100%;
    }

    form{
        width:30%;
        margin: 60px auto 40px;
        height:25vh;
    }

    #button_register{
        color: #FFFFFF;
        font-family: Helvetica;
        font-size: 15px;
        background-color: #FFAE00;
        text-decoration: none;
        cursor: pointer;
        padding:15px 15px;
        border: #FFAE00;
        border-radius: 38px;
        font-weight:600;
        line-height:5px;
        margin-top:15px;
        width:80px;
    }

    #button_register:hover {
        border: solid #FFAE00;
        text-decoration: none;
        background-color: #332b27;
        transform: translate(0, 0);
        -ms-transform: translate(-50%, -50%);
   }

</style>