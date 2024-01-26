<div id="contact">
    <div class="footer-container">
        <div class="contact">
            <h3>Contact Us</h3>
            <ul class="contact-text">
                <li>Email : const@yahoo.com</li>
                <li>Phone : +6282183503540</li>
                <li>Address : Universitas Teknokrat Indonesia</li>
            </ul>
        </div>
        <div class="route-page">
            <h3>Route Pages</h3>
            <ul class="contact-text">
                <li><a href="#home" title="Home">Home</a></li>
                <li><a href="#about" title="About">About Us</a></li>
                <li><a href="#events" title="Events">Events</a></li>
                <li><a href="#contact" title="Contacts">Contacts</a></li>
                <li class="route-btm">
                    @if (Auth::guard('admin')->check())
                        <h4>{{ auth()->guard('admin')->user()->name }}</h4>
                        <div class=" route-icons-btm">
                            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-laptop-code"
                                    title="Dashboard"></i></a>
                            <a href="{{ route('logout') }}"><i class="fa-solid fa-door-open" title="LogOut"></i></a>
                        </div>
                    @elseif(Auth::check())
                        {{-- <h4>{{ auth()->user()->name }}</h4> --}}
                        <a class="log" href="{{ route('logout') }}" onclick="resetSeenNotification()"
                            title="LogOut">LogOut</a>
                    @else
                        <a class="log" href="{{ route('login') }}" title="LogIn">LogIn</a>
                    @endif
                </li>
            </ul>
        </div>

        <div class="download">
            <h3>Tvent Mobile Apps <i class="fa-solid fa-mobile-screen"></i></h3>
            <ul class="contact-text">
                <li><a href="https://github.com/Informatika-C/Tvent-Mobile/releases/download/Tvent/app-release.apk">Android
                        <i class="fa-brands fa-android"></i></a></li>
                <li> <img src="{{ asset('assets/images/tvent-v1.0.0.png') }}" alt="Sponsor Logo 5" /></li>
                {{-- <li><a href="">IOS <i class="fa-brands fa-apple"></i></a></li> --}}
            </ul>
        </div>

        <div class="img-footer">
            <img src="{{ asset('assets/images/uti.png') }}" alt="img-footer" />
        </div>
    </div>
</div>
<footer>
    <p class="copyright">&copy; 2023 Const. All Rights Reserved.</p>
</footer>
