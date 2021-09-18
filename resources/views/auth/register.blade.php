@extends('layouts.auth')

@section('content')
<body class="gray-bg">
    
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            
            <h3>Register to Chat Room</h3>
            <p>Create account to see it in action.</p>
            
            
            <form class="m-t" method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    
                        <input id="name" placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                
                <div class="form-group">
                    <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                
                <div class="form-group">
                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
                
                <div class="form-group">
                    <input id="password-confirm" placeholder="Password Confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">
                            {{ __('Register') }}
                        </button>
                        <p class="text-muted text-center"><small>Already have an account?</small></p>
                        <a class="btn btn-sm btn-white btn-block" href="{{route('login')}}">Login</a>
                    </form>
        </div>
    </div>
    @endsection

