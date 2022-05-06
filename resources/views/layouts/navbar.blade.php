<nav class="flex justify-between items-center mb-4">
    <a href="{{ route('home') }}"
        ><img class="w-24" src="images/logo.png" alt="" class="logo"
    /></a>
    <ul class="flex space-x-6 mr-6 text-lg">
        @auth
            <li>
                <p class="hover:text-laravel text-xl font-bold">
                    <i class="fa-solid fa-user"></i> Welcome Back, {{ auth()->user()->name }}
                </p>
            </li>
            <li>
                <a href="register.html" class="hover:text-laravel"
                    ><i class="fa-solid fa-gear"></i> Manage Gigs</a
                >
            </li>
            <li>
                <a href="{{ route('logout') }}" class="hover:text-laravel"
                    ><i class="fa-solid fa-door-closed"></i>
                    Logout</a
                >
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('register') }}" class="hover:text-laravel"
                    ><i class="fa-solid fa-user-plus"></i> Register</a
                >
            </li>
            <li>
                <a href="{{ route('login') }}" class="hover:text-laravel"
                    ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a
                >
            </li>
        @endguest

    </ul>
</nav>