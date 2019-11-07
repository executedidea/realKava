{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">

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
                    name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
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
    <title>Sign Up | KAVA</title>

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
                                    <h4 class="mb-4">Create an Account</h4>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-6 text-center">
                                                <form method="POST" action="{{ route('register') }}">
                                                    @csrf
                                                    <div class="md-form md-outline">
                                                        <input type="text" name="name" id="name" class="form-control"
                                                            value="{{ old('name') }}" required autocomplete="name"
                                                            autofocus>
                                                        <label for="name">{{ __('Name') }}</label>
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="md-form md-outline">
                                                        <input type="text" name="username" id="username"
                                                            class="form-control" value="{{ old('username') }}" required
                                                            autocomplete="username">
                                                        <label for="username">{{ __('Username') }}</label>
                                                        @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="md-form md-outline">
                                                        <input type="email" name="email" id="email" class="form-control"
                                                            value="{{ old('email') }}" required autocomplete="email">
                                                        <label for="email">{{ __('E-mail') }}</label>
                                                        @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="md-form md-outline">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control" required autocomplete="new-password">
                                                        <label for="password">Password</label>
                                                    </div>
                                                    <div class="md-form md-outline">
                                                        <input type="password" id="password-confirm"
                                                            name="password_confirmation" class="form-control" required
                                                            autocomplete="new-password">
                                                        <label for="password-confirm">Password</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-info btn-block my-4">Sign
                                                        Up</button>
                                                    <span>Already have an account? <a
                                                            href="{{route('login')}}">Login</a></span>
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
