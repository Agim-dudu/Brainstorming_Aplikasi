<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Double Slider Login / Registration Form</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/login-register/style.css">
</head>

<body>
    <div class="container" id="container">

        <div class="form-container register-container">
            <form action="{{route('register.store')}}" class="signin-form" method="post">
                @csrf
                <h1>register</h1>
                <input type="text" class="form-control @error('UsernameInput') is-invalid @enderror"
                    placeholder="Username" required id="UsernameInput" name="UsernameInput"
                    value="{{ old('UsernameInput') }}">
                @error('UsernameInput')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input type="email" class="form-control @error('emailInput') is-invalid @enderror" placeholder="Email"
                    required id="emailInput" name="emailInput" value="{{ old('emailInput') }}">
                @error('emailInput')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input type="password" class="form-control @error('passwordInput') is-invalid @enderror"
                    placeholder="Password" required id="passwordInput" name="passwordInput">
                @error('passwordInput')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input type="password" class="form-control @error('passwordInput_confirmation') is-invalid @enderror"
                    placeholder="Konfirmasi Password" required id="passwordInput_confirmation"
                    name="passwordInput_confirmation">
                @error('passwordInput_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <button type="submit">Register</button>
                <span>or use your account</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                    <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
                </div>
            </form>
        </div>

        <div class="form-container login-container">
            <form action="{{route('login.auth')}}" class="signin-form" method="post">
                @csrf
                <h1>Login hire.</h1>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email"
                    required id="email" name="email" value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Password" required>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <div class="content">
                    <div class="checkbox">
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label>Remember me</label>
                    </div>
                    <div class="pass-link">
                        <a href="#">Forgot password?</a>
                    </div>
                </div>
                <button type="submit">Login</button>
                <span>or use your account</span>
                <div class="social-container">
                    <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
                    <a href="#" class="social"><i class="lni lni-google"></i></a>
                    <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
                </div>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title">Hello <br> friends</h1>
                    <p>if Yout have an account, login here and have fun</p>
                    <button class="ghost" id="login">Login
                        <i class="lni lni-arrow-left login"></i>
                    </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Start yout <br> journy now</h1>
                    <p>if you don't have an account yet, join us and start your journey.</p>
                    <button class="ghost" id="register">Register
                        <i class="lni lni-arrow-right register"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('/') }}assets/login-register/script.js"></script>

</body>

</html>
