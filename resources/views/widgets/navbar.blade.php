<div class="navbar" id="myNavbar" data-aos="fade-down" data-aos-duration="1500">
    <div class="brand">
        <a class="active" href="./home.html">Tvent</a>
    </div>
    <ul class="nav-menu">
        <ul class="menu" id="navbarOverlay">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#events">Events</a></li>
            <li><a href="#contact">Contacts</a></li>
            <li class="route">
                @if(Auth::guard('admin')->check())
                <h4>{{ auth()->guard('admin')->user()->name }}</h4>
                <div class="route-icons">
                    <a href="{{route('dashboard')}}"><i class="fa-solid fa-laptop-code" title="Dashboard"></i></a>
                    <a href="{{route('logout')}}"><i class="fa-solid fa-door-open" title="LogOut"></i></a>
                </div>
                @elseif(Auth::check())
                <h4>{{ auth()->user()->name }}</h4>
                <div class="route-icons">
                    <a href="{{route('logout')}}"><i class="fa-solid fa-power-off" title="LogOut"></i></a>
                </div>
                @else
                please
                <a href="{{route('login')}}">LogIn</a>
                @endif
            </li>
        </ul>
        <ul class="tools">
            <div class="dark-mode-switch">
                <input type="checkbox" id="darkModeToggle" />
                <label for="darkModeToggle"></label>
            </div>
            <div class="toggle-btn" id="toggleNavbar">
                <i class="fas fa-bars fa-lg"></i>
            </div>
        </ul>
    </ul>
</div>