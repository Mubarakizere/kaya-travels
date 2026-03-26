<x-guest-layout>
    <!-- Logo -->
    <div class="auth-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Kaya Travel & Tours">
        </a>
    </div>

    <!-- Brand -->
    <div class="auth-brand">
        <h1>Welcome Back</h1>
        <p>Sign in to your travel account</p>
    </div>

    <div class="auth-divider">
        <span>Login</span>
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="session-status">{{ session('status') }}</div>
    @endif

    <!-- Login Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <div class="input-wrapper">
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="your@email.com"
                    required
                    autofocus
                    autocomplete="username"
                >
                <i class="bi bi-envelope"></i>
            </div>
            <x-input-error :messages="$errors->get('email')" class="input-error" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
                <i class="bi bi-lock"></i>
            </div>
            <x-input-error :messages="$errors->get('password')" class="input-error" />
        </div>

        <!-- Remember + Forgot -->
        <div class="auth-links">
            <div class="form-check">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot password?</a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-gold">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Sign In</span>
        </button>
    </form>

    <!-- Footer -->
    <div class="auth-footer">
        <p>Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
    </div>
</x-guest-layout>
