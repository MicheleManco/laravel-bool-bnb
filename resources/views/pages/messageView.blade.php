@extends('layouts.main-layout')

@section('content')

    <message-view
    :apartment = '{{json_encode($apartment)}}'
    :messages = '{{json_encode($messages)}}'
    :filtered_messages = '{{json_encode($filteredMessages)}}'>

</message-view>
@endsection