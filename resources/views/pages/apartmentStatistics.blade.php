
@extends('layouts.main-layout')

@section('content')
    <apartment-stats :statistics = '{{json_encode($statistics)}}'></apartment-stats>
@endsection