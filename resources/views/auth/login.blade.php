<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/sign.css') }}" />
</head>

<body>
    <div id="vantajs"></div>
    <div class="brand">
        <h1>Tvent</h1>
        <h1>Tvent</h1>
    </div>
    <div class="container">
        <form class="signIn" method="POST" action="{{ route('login') }}">
            @csrf

            <h3 style="padding-bottom: 1rem">{{ __('Login') }}</h3>
            <button class="fb" type="button">HI, Welcomeback !</button>

            <div class="input">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="check">
                <label class="checkbox-container form-check-label" for="remember">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="bottom">
                <button class="btn form-btn dx" type="submit">{{ __('Login') }}</button>
                <p>- or -</p>
                <p>Don't have an account yet? <b class="form-btn sx back" type="button"> Sign Up</b></p>
            </div>
        </form>

        <form class="signUp" method="POST" action="{{ route('register') }}">
            @csrf
            <h3>{{ __('Register') }}</h3>
            <div class="input">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus />
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input">
                <label for="email">{{ __('NPM') }}</label>
                <input id="npm" type="number" class="form-control @error('npm') is-invalid @enderror" name="npm"
                    value="{{ old('npm') }}" required autocomplete="npm" />
                @error('npm')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input">
                <label for="email">{{ __('Phone') }}</label>
                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" required autocomplete="phone" />
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" />
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
    <script>
    const logInButton = document.querySelector(".log-in");
    const signIn = document.querySelector(".signIn");
    const signUp = document.querySelector(".signUp");
    const backButton = document.querySelector(".back");

    logInButton.addEventListener("click", function() {
        signIn.classList.add("active-dx");
        signUp.classList.add("inactive-sx");
        signUp.classList.remove("active-sx");
        signIn.classList.remove("inactive-dx");
    });

    backButton.addEventListener("click", function() {
        signUp.classList.add("active-sx");
        signIn.classList.add("inactive-dx");
        signIn.classList.remove("active-dx");
        signUp.classList.remove("inactive-sx");
    });
    </script>

</body>