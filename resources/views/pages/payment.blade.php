@extends('layouts.main-layout')

@section('content')


{{$apartment_id}}
    <form action="{{ route('paymentStore',['apartment_id' => $apartment_id,'sponsor_id' => $sponsor_id])}}" method="post" >
    @method('POST') @csrf 
    <input type="text" name="'start_date'" value="test"><br>
        <input type="submit" value="CREATE" class="btn btn-primary">

    </form>
    payment
@endsection
