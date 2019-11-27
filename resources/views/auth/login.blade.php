@extends('layout')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="auth-left">
            <h2>Hello, Customer !!</h2>
            <div class="spacer"></div>
            <form action="{{ route('login') }}" method="POST">

                @csrf
                <div class="email">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') ?? '' }}"
                        placeholder="Your email here ..." required autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="password">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') ?? '' }}"
                        placeholder="Your password here ..." required autofocus>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="login-container">
                    <button type="submit" class="auth-button">Login</button>

                    <label class="form-check-label" for="remember">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="spacer"></div>

                <a href="{{ route('password.request') }}">
                    Forgot your password ??
                </a>
            </form>

        </div>
        <div class="auth-right">
            <h2>New Customer</h2>
            <p style="font-weight: bold;">Save time now ??</p>
            <p>You don't need an account to checkout</p>
            <div class="spacer"></div>

            @if ( strpos(url()->previous(), '/cart') )

            <a class="auth-button-hollow" href="{{ route('guestcheckout.index') }}">
                Checkout as a Guest
            </a>

            @else

            <a class="auth-button-hollow" href="{{ route('shop.index') }}">
                Let's go Shopping first
            </a>

            @endif

            <div class="spacer"></div>
            <p style="font-weight: bold;">Save time later ??</p>
            <p>Create an account in an ease to easily checkout and access to your own order history</p>
            <div class="spacer"></div>
            <a class="auth-button-hollow" href="{{ route('register') }}">
                Create new Account
            </a>
        </div>
    </div>

    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}
</div>

<div class="card-body">

    @include('partials.alert')

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

                @if ( strpos(url()->previous(), '/cart') )
                <a class="btn btn-link" href="{{ route('guestcheckout.index') }}">
                    Checkout as a Guest ??
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div> --}}
</div>
@endsection
