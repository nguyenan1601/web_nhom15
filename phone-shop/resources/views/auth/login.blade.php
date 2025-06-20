@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="card auth-card">
    <div class="card-header">
        <h4 class="text-center mb-0">Login</h4>
    </div>
    <div class="card-body p-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
            <br>
            <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account? Register</a>
        </div>
    </div>
</div>
@endsection
