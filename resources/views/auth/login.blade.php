{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | KAVA</title>

    <link rel="stylesheet" href="{{asset('/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/modules/fontawesome/css/all.min.css')}}">
    <link href="{{asset('/css/mdb.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/login.css')}}" rel="stylesheet">

    <script src="{{asset('/modules/jquery.min.js')}}"></script>
</head>

<body>
    <header>
        <div class="view" style="background-image: url('{{asset('img/backgrounds/login.jpg')}}');">
            <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center text-md-left mt-xl-5 mb-5">
                            <div class="card p-5">
                                <div class="card-body text-center">
                                    <h4 class="mb-4">Login To Your Account</h4>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-5 text-center">
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="md-form md-outline">
                                                        <input type="text" name="identity" id="identity"
                                                            class="form-control" value="{{ old('identity') }}" required
                                                            autocomplete="identity" autofocus>
                                                        <label for="identity">{{ __('E-mail or Username') }}</label>
                                                    </div>
                                                    <div class="md-form md-outline">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control" required
                                                            autocomplete="current-password">
                                                        <label for="password">Password</label>
                                                        @if (Route::has('password.request'))
                                                        <p class="font-small blue-text d-flex justify-content-end">
                                                            Forgot <a href="{{ route('password.request') }}"
                                                                class="blue-text ml-1">
                                                                Password?</a></p>
                                                        @endif
                                                    </div>
                                                    <div class="md-form mt-4">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block">Login</button>
                                                    </div>
                                                    <a href="{{route('register')}}"
                                                        class="btn btn-info btn-block mt-4">Sign
                                                        Up</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>


    <script src="{{asset('/modules/popper.js')}}"></script>
    <script src="{{asset('/modules/tooltip.js')}}"></script>
    <script src="{{asset('/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/mdb.min.js')}}"></script>
</body>

</html>
