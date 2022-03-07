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
    <div id="containerForm" class="mx-auto my-5">
        <form class="form mx-auto" action="{{route('login')}}" method="POST">

            @method('POST')
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Password</label>
            <input type="password" name="password">

            <input class='my-4 btn' type="submit" value="Login">
        </form>
    </div>
    
@endsection