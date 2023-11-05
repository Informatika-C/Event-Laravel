<div class="navbar" id="myNavbar" data-aos="fade-down" data-aos-duration="1500">
    <div class="brand">
        <a class="active" href="/" title="Home">
            {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="logo"> --}}
            Tvent
        </a>
    </div>
    <ul class="nav-menu">
        <ul class="menu" id="navbarOverlay">
            <li><a href="#home" title="Home">Home</a></li>
            <li><a href="#about" title="About">About Us</a></li>
            <li><a href="#events" title="Events">Events</a></li>
            <li><a href="#contact" title="Contacts">Contacts</a></li>
            <li>
                @if(Auth::guard('admin')->check() || Auth::check())
                <a class="dropdown-trigger" title="Menu">
                    {{ Auth::guard('admin')->check() ? auth()->guard('admin')->user()->name : auth()->user()->name }}
                    <i class="fa-solid fa-caret-right"></i>
                </a>
                <ul class="nav-dropdown">
                    <li><i class="fa-solid fa-user" title="Profile"></i><a href="{{ Auth::guard('admin')->check() ? route('profile') : route('user.profile') }}">Profile</a></li>
                    @if(Auth::guard('admin')->check())
                        <li><i class="fa-solid fa-laptop-code" title="Dashboard"></i><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                    <li><i class="fa-solid fa-power-off" title="LogOut"></i><a href="{{ route('logout') }}" onclick="resetSeenNotification()">LogOut</a></li>
                </ul>
                {{-- @else
                    <a class="login" href="{{ route('login') }} " title="LogIn">LogIn</a> --}}
                @endif
            </li>
        </ul>
        <li class="tools">
            <div class="dark-mode-switch">
                <input type="checkbox" id="darkModeToggle" />
                <label for="darkModeToggle" title="Mode"></label>
            </div>
            <div class="toggle-btn" id="toggleNavbar">
                <i class="fas fa-bars fa-lg"></i>
            </div>
        </li>
    </ul>
</div>