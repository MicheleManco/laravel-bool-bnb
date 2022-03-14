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

