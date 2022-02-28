<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- tomtom CDN --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.15.0/services/services-web.min.js"></script>

    <link rel="stylesheet" href={{asset("css/app.css")}}>
    <script src={{asset("js/app.js")}}></script>
    <title>BoolBnB.com</title>
</head>
<body>
    <div id="app">
        @include('components.header-home')
        @yield('content')
        @include('components.footer')
    </div>
</body>
</html>