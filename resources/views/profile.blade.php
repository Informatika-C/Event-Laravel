<html lang="en">
@include('widgets.head')
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />

<body>
    @include('widgets.navbar')
    <div id="profile" class="container-profile">
        <div class="profile">
            <div class="profile-detail">
                <div class="detail-header">
                    <div class="img-container">
                        {{-- {{ __('User Profile') }} --}}
                        <img src="{{ asset('assets/images/profile.png') }}" alt="Profile Image">
                    </div>
                    <h1 class="usn">{{ Auth::user()->name }}</h1>
                </div>
                <br>
                <li class="list-group-item"><strong>Email:</strong> {{ Auth::user()->email }}</li>
                <li class="list-group-item"><strong>NPM:</strong> {{ Auth::user()->npm }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ Auth::user()->phone }}</li>
            </div>
            <div class="tab-bar-case">
                <div class="tab-detail">
                    <div class="tab-bar">
                        <button id="tab1" class="tab-button active" onclick="showTab('tab1')">
                            <i class="fa-solid fa-earth-americas"></i>
                        </button>
                        <button id="tab2" class="tab-button" onclick="showTab('tab2')">
                            <i class="fa-solid fa-house-fire"></i>
                        </button>
                        <button id="tab3" class="tab-button" onclick="showTab('tab3')">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                    </div>
                    <div class="tab-contents">
                        <h1>Events</h1>
                        <div id="content-tab1" class="tab-content active">
                            <div class="content-event">
                                <div class="container-event">
                                    <div class="image-event"></div>
                                    <div class="detail-event">
                                        <h4>Event Kampus</h4>
                                        <h5>Tanggal</h5>
                                        <h5>Kuota</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content-tab2" class="tab-content ">
                            <p>Tab 2.</p>
                        </div>
                        <div id="content-tab3" class="tab-content ">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" class="form-edit-profile"
                                        action="{{ route('update-profile') }}">
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
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
</body>

</html>
