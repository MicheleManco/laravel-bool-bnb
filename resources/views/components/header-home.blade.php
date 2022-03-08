<header> 
    @guest
    <div id="icons">
       <a href="{{route('pageRegister')}}">Registrati</a> | <a href="{{route('pageLogin')}}">Login</a>
    </div>
    
    @else
        {{-- se l'utente è autenticato mostra il suo nome e i link alla dashboard personale e per il logout --}}
        <h2> Hello to {{Auth::user() -> name }}</h2>
        <a href="{{route('userDashboard')}}"> DASHBOARD</a>
        <a href="{{route('logout')}}"> LOGOUT</a>
    @endguest
</header>



