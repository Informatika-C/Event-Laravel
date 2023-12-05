<link rel="stylesheet" href="{{ asset('assets/css/notify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
<div class="notif-manager">
    @if (Auth::guard('admin')->check() || Auth::check())
        <div class="notification" id="notification">
            Hi! Welcome
            <b>{{ Auth::guard('admin')->check()? auth()->guard('admin')->user()->name: auth()->user()->name }}</b>
            <span class="hide-icon" onclick="hideNotification()"><i class="fa-solid fa-xmark"></i></span>
        </div>

        <div class="notify-container">
            <span class="close-icon" onclick="closeNotification()"><i class="fa-solid fa-xmark"></i></span>
            <h1>Category Here!</h1>
            <p>Selamat datang di Tvent, wahana kreativitas tanpa batas! 🚀✨ Temukan dunia baru inspirasi dan pengalaman
                unik bersama kami. </p>
            <div class="hashtags">
                <span class="hashtag">Seni</span>
                <span class="hashtag">IT</span>
                <span class="hashtag">E-sport</span>
                <span class="hashtag">Non Academic</span>
            </div>
        </div>
    @else
        <div class="notification logout" id="notification">
            <a href="{{ route('login') }} " title="LogIn">LogIn </a>Required!
            <span class="hide-icon" onclick ="hideNotification()"><i class="fa-solid fa-xmark"></i></span>
        </div>
    @endif
</div>

<script src="{{ asset('assets/js/notify.js') }}"></script>
