<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="/">
                LOGO
            </a>
        </div>
    
        <div class="flex gap-x-5 items-center">
            @guest
            <a href="{{ route('login') }}">Sign In</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
            @endguest
            @auth
            <form action="{{ route('logout') }}" method="post">@csrf <button type="submit" class="btn">Logout</button></form>
            @endauth

            
        </div>

    </div>
</nav>