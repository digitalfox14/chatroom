@extends('layouts.auth')

@section('content')

<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>   
        <h3>Welcome to Chat Room</h3>
    
        <p>Login in. To see it in action.</p>
        
        
        
        <form class="m-t" method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">
                {{ __('Login') }}
            </button>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>
        </form>
    </div>
</div>
@endsection

