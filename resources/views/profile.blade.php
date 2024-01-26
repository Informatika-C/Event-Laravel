<html lang="en">

<head>
    @include('widgets.head')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/eventpgs.css') }}" />

    <title>{{ Auth::user()->name }} - ProfilePage</title>
</head>

<body>
    {{-- {{ $lomba }} --}}
    @include('widgets.navbar')
    <div id="profile" class="container-profile">
        <div class="profile">
            <div class="profile-detail">
                <div class="img-container">
                    {{-- {{ __('User Profile') }} --}}
                    <img src="{{ asset('assets/images/profile.png') }}" alt="Profile Image">
                </div>
                <div class="detail-header">
                    <h1 class="usn">{{ Auth::user()->name }}</h1>

                    <li class="list-group-item"><strong>Email :</strong> {{ Auth::user()->email }}</li>
                    <li class="list-group-item"><strong>NPM :</strong> {{ Auth::user()->npm }}</li>
                    <li class="list-group-item"><strong>Phone :</strong> {{ Auth::user()->phone }}</li>
                </div>
            </div>
            <div class="tab-bar-case">
                <div class="tab-detail">
                    <div class="tab-bar">
                        <button id="tab1" class="tab-button active" onclick="showTab('tab1')">
                            <i class="fa-solid fa-house-fire"></i>
                            <p class="active">Your Events</p>
                        </button>
                        <button id="tab2" class="tab-button" onclick="showTab('tab2')">
                            <i class="fa-solid fa-gear"></i>
                            <p class="active">Setting's</p>
                        </button>
                    </div>
                    <div class="tab-contents">
                        <div id="content-tab1" class="tab-content active">
                            @if ($lomba->isEmpty())
                                <p>You haven't taken part in any events or competitions yet.</p>
                            @else
                                <h1>Events</h1>
                                <ul class="cards">
                                    @foreach ($lomba as $lomba)
                                        <li class="cards__item">
                                            <div class="card">
                                                <div class="card__image"
                                                    style="background-image: url('{{ asset('storage/banner/' . $lomba->event->id . '/' . $lomba->event->banner) }}');">
                                                </div>
                                                <div class="card__content">
                                                    <div class="card__title">{{ $lomba['nama_lomba'] }}</div>
                                                    <p class="card__text">{{ $lomba->deskripsi }}</p>
                                                    <div class="blog__author_container">
                                                        <div class="blog__author_details">
                                                            <span class="blog__author_name">
                                                                {{ $lomba['max_anggota'] }} / Group</span>
                                                            <span class="blog__author_date">
                                                                <i
                                                                    class="fa-solid fa-location-dot"></i>{{ $lomba->ruangan_lomba }}
                                                            </span>
                                                            <span class="blog__author_date">
                                                                <i class="fa-solid fa-stopwatch"></i>
                                                                {{ Carbon\Carbon::parse($lomba->pelaksanaan_lomba)->format('l, j F Y') }}
                                                                <time>
                                                                    {{ Carbon\Carbon::parse($lomba->pelaksanaan_lomba)->format('H:i') }}
                                                                </time>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <form action="{{ route('lomba.unregister') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="lomba_id" value="{{ $lomba->id }}">
                                                    <button type="submit"
                                                        style="background: red; color:white">Out</button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                        <div id="content-tab2" class="tab-content ">
                            <h1>Edit Profile</h1>
                            <div class="form">
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
                                            <label for="password">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control" name="password"
                                                value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">{{ __('Password Confirm') }}</label>
                                            <input id="password_confirmation" type="password_confirmation"
                                                class="form-control" name="password_confirmation">
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
                                @include('widgets.alert')
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
