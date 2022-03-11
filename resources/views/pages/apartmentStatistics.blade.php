

@extends('layouts.main-layout')
@section('content')

ciao

    <apartment-stats
    :statistics_views = '{{json_encode($statViews)}}'
    :statistics_messages = '{{json_encode($statMessage)}}'
    >

    </apartment-stats>



@endsection