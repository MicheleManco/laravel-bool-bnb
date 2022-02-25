<header>
    @guest
        <form action="{{route('register')}}" method="POST">

            @method('POST')
            @csrf

            <label for="name">Nome</label>
            <input type="text" name="name">
            <label for="surname">Cognome</label>
            <input type="text" name="surname">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Password</label>
            <input type="password" name="password">
            <label for="password_confirmation">Password-confirmation</label>
            <input type="password" name="password_confirmation">
            <label for="birthday">Data di nascita</label>
            <input type="date" name="birthday">
            <label for="description">Descrizione</label>
            <input type="textarea" name="description">
            
            <input type="submit" value= "Register">
        </form>

        <form action="{{route('login')}}" method="POST">

            @method('POST')
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Password</label>
            <input type="password" name="password">

            <input type="submit" value="Login">
        </form>
    @else
        <h2> Hello to {{Auth::user() -> name }}</h2>
        <a href="{{route('userDashboard')}}"> DASHBOARD</a>
        <a href="{{route('logout')}}"> LOGOUT</a>
    @endguest
</header>