<html lang="en">
@include('widgets.head')

<body>
    <div id="profile" class="container">
        <div class="brand">
            <a class="active" href="/">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo" title="Tvent">
                {{-- Tvent --}}
            </a>
        </div>
        <div class="profile">
            <div class="profile-header">
                <div class="img-container">
                    {{-- {{ __('User Profile') }} --}}
                    <img src="{{ asset('assets/images/profile.png') }}" alt="Profile Image">
                </div>
                <h1 class="usn">{{ Auth::user()->name }}</h1>
                <p class="dsc">Deskripsi</p>
                <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                <li class="list-group-item"><strong>NPM:</strong> {{ Auth::user()->npm }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ Auth::user()->phone }}</li>
            </div>
            <div class="tab-bar">
                <button id="tab1" class="tab-button active" onclick="showTab('tab1')">Tab 1</button>
                <button id="tab2" class="tab-button" onclick="showTab('tab2')">Tab 2</button>
                <button id="tab3" class="tab-button" onclick="showTab('tab3')">Tab 3</button>
            </div>
            <div id="content-tab1" class="tab-content active">
                <h6>Tab 1 Content</h6>
                <p>Tab 1.</p>
            </div>
            <div id="content-tab2" class="tab-content">
                <h6>Tab 2 Content</h6>
                <p>Tab 2.</p>
            </div>
            <div id="content-tab3" class="tab-content">
                <h6>Tab 3 Content</h6>
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update-profile') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ Auth::user()->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ Auth::user()->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="npm">{{ __('NPM') }}</label>
                                <input id="npm" type="number" class="form-control" name="npm"
                                    value="{{ Auth::user()->npm }}" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input id="phone" type="number" class="form-control" name="phone"
                                    value="{{ Auth::user()->phone }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
</body>

</html>
