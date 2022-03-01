@extends('layouts.main-layout')
@section('content')

    <?php
    $associatedApartments = array();
    ?>
    
    @foreach ($apartments as $apartment)        
    <?php
        $associateApartment = array(
            "apartment" => array(),
            "category" => array(),
            "services" => array(),
        );
    ?>
        @foreach ($categories as $category)
            @if ($category->id == $apartment->category->id)
                <?php
                    $associateApartment["apartment"] = $apartment;
                    $associateApartment["category"] = $category;
                ?>
            @endif
        @endforeach
                
        @foreach ($services as $service)
            @foreach ($apartment->services as $apartmentService)
                @if ($service->id == $apartmentService->id)
                <?php
                    array_push($associateApartment["services"], $service);
                ?>
                @endif
            @endforeach
        @endforeach
    <?php
        array_push($associatedApartments, $associateApartment);
    ?>
    @endforeach

    <advanced-search-component
        :apartments = '{{json_encode($associatedApartments)}}'
    >
    </advanced-search-component>
@endsection
