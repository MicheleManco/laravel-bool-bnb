

@extends('layouts.main-layout')
@section('content')

ciao

    <apartment-stats
    :apartment = '{{json_encode($apartment)}}'
    :stat = '{{json_encode($stats)}}'
    >

    </apartment-stats>



@endsection