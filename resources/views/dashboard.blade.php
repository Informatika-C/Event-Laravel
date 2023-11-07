<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <title>Dashboard</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image"><img src="{{ asset('assets/images/uti.png') }}" alt="" /></div>
            <span class="logo_name">Tvent</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-chalkboard"></i>
                        <span class="link-name">Dahsboard</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'dashboard.events' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.events') }}">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span class="link-name">Events</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'dashboard.penyelenggara' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.penyelenggara') }}">
                        <i class="fa-solid fa-people-group"></i>
                        <span class="link-name">Autors</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'dashboard.contestant' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.contestant') }}">
                        <i class="fa-solid fa-users"></i>
                        <span class="link-name">Contestants</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'dashboard.schedule' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.schedule') }}">
                        <i class="fa-solid fa-calendar-day"></i>
                        <span class="link-name">Schedule</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'dashboard.sponsor' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.sponsor') }}">
                        <i class="fa-solid fa-handshake-angle"></i>
                        <span class="link-name">Sponsor</span>
                    </a>
                </li>
                <li class="mode">
                    <a href="#">
                        <i class="fa-solid fa-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>

            <ul class="logout-mode">
                @if(Auth::guard('admin')->check())
                <li>
                    <a href="{{route('logout')}}" title="LogOut">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="link-name">Logout</span>
                    </a>
                    @elseif(Auth::check())
                    <a href="{{route('logout')}}" title="LogOut">LogOut</a>
                </li>
                @endif
                <li>
                    <a href="/"  title="LogOut">
                        <i class="fa-solid fa-house"></i>
                        <span class="link-name" title="Home">Home</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <input type="checkbox" id="toggle" />
            <label class="side-toggle sidebar-toggle" for="toggle"><span class="fas fa-bars"></span></label>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search here..." />
            </div>
            <div class="profile">
                <img class="profile-image" alt="no avaible image" src="{{ asset('assets/images/3.svg') }}" />
                @if(Auth::guard('admin')->check())
                <p class="profile-name">{{ auth()->guard('admin')->user()->name }}</p>
                @endif
            </div>
        </div>
        <div class="popup-box">
            <div class="popup">
                <div class="content">
                    <header>
                        <p></p>
                        <i class="fa-solid fa-xmark"></i>
                    </header>
                    <form action="#">
                        <div class="row title">
                            <label>Title</label>
                            <input type="text" spellcheck="false" />
                        </div>
                        <div class="row description">
                            <label>Description</label>
                            <textarea spellcheck="false"></textarea>
                        </div>
                        <button></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="wrapper" style="display: none">
            <li class="add-box" >
                <div class="icon"><i class="fa-solid fa-plus"></i></div>
                <p>Add new note</p>
            </li>
        </div>

        <main style="    margin-top: 70px;">@yield('content')</main>
    </section>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>

</html>