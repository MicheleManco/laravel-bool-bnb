@extends('layouts.main-layout')
@section('content')

    <home-search
    :apartment_sponsorship = '{{json_encode($apartmentSponsorship)}}'
    :filter_sponsor = '{{json_encode($filterSponsor)}}'>

    </home-search>

</div>
@endsection
