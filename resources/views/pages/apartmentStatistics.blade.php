{{-- @foreach ($filteredMessages as $message)
    {{$message->id}}
    {{$message->text}} <br>
@endforeach --}}

@extends('layouts.main-layout')
@section('content')
messaggi : {{ count($filteredMessages) }}
<br>
visite: {{$apartment->views}}



@endsection