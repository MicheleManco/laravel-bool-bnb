<header> 

    <a href="{{route('home')}}" class="logo">
        <h1>
            BoolBNB
        </h1>
    </a>

    @guest
    <div id="icons" class="guest">
       <a href="{{route('pageRegister')}}">Registrati</a> | 
       <a href="{{route('pageLogin')}}">Login</a>
    </div>
    
    @else
        <div class="logged-user">
            {{-- se l'utente è autenticato mostra il suo nome e i link alla dashboard personale e per il logout --}}
            <h4> Bentornato {{Auth::user() -> name }}!</h4>
            <a href="{{route('userDashboard')}}">Dashboard</a> |
            <a href="{{route('logout')}}"> Logout</a>
        </div>
    @endguest
</header>



