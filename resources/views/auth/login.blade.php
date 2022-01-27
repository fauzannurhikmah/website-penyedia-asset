@extends('layouts.app',['title'=>'Login'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 align-self-center">
            <img src="{{asset('img/assets/draw2.png')}}" alt="" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h3 class="mb-3"><i class="fa-1x fas fa-sign-in-alt"></i> Login</h3>
            <div class="card card-body">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sunt itaque quos cum dolorum vel illo asperiores fugit, suscipit quisquam a aspernatur maiores?
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>
                        <div class="form-group mb-0">
                                <button type="submit" class="btn btn-lg btn-custom">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
