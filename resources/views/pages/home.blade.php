@extends('layouts.main-layout')
@section('content')

    <home-search
    :apartment_sponsorship = '{{json_encode($apartmentSponsorship)}}'>

    </home-search>

</div>
@endsection
