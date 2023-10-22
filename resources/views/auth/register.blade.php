<head>
    <link rel="stylesheet" href="{{ asset('assets/css/sign.css') }}" />
</head>
<div id="vantajs"></div>
<div class="brand">
    <h1>Tvent</h1>
    <h1>Tvent</h1>
</div>
<div class="container">
    <form class="signUp" method="POST" action="{{ route('register') }}">
        @csrf
        <h3>{{ __('Register') }}</h3>
        <div class="input">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input">
            <label for="email">{{ __('NPM') }}</label>
            <input id="npm" type="number" class="form-control @error('npm') is-invalid @enderror" name="npm" value="{{ old('npm') }}" required autocomplete="npm" />
            @error('npm')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input">
            <label for="email">{{ __('Phone') }}</label>
            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" />
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="bottom2">
            <button class="form-btn dx" type="submit">{{ __('Register') }}</button>
            <p>- or -</p>
            <p>Already have an account? <b class="form-btn sx log-in" type="button"> Sign In</b></p>
        </div>
    </form>
</div>
<script src="{{ asset('assets/js/sign.js') }}"></script>