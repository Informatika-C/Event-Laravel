
<html lang="en">
@include('widgets.head')
    <body>
        <div id="home" class="container">
            <div class="navbar" id="myNavbar">
                <div class="brand">
                    <a class="active" href="/">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" title="Tvent">
                        {{-- Tvent --}}
                    </a>
                </div>
            </div>
            <div class="profile">
                <div class="profile-header">
                    <div class="img-container">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="Profile Image">
                    </div>
                    @if(Auth::guard('admin')->check() || Auth::check())
                    <h1 class="usn">{{ Auth::guard('admin')->check() ? auth()->guard('admin')->user()->name : auth()->user()->name }}</h1>
                    @endif
                    <p class="dsc">Deskripsi</p>
                </div>
                <div class="tab-bar">
                    <button id="tab1" class="tab-button active" onclick="showTab('tab1')">Tab 1</button>
                    <button id="tab2" class="tab-button" onclick="showTab('tab2')">Tab 2</button>
                    <button id="tab3" class="tab-button" onclick="showTab('tab3')">Tab 3</button>
                </div>
                <div id="content-tab1" class="tab-content active">
                    <h2>Tab 1 Content</h2>
                    <p>Tab 1.</p>
                </div>
                <div id="content-tab2" class="tab-content">
                    <h2>Tab 2 Content</h2>
                    <p>Tab 2.</p>
                </div>
                <div id="content-tab3" class="tab-content">
                    <h2>Tab 3 Content</h2>
                    <p>Tab 3.</p>
                </div>
            </div>
        </div>
    </body>
</html>
