<x-guest-layout>
    <!-- Logo -->
    <div class="auth-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Kaya Travel & Tours">
        </a>
    </div>

    <!-- Brand -->
    <div class="auth-brand">
        <h1>Join the Journey</h1>
        <p>Create your Kaya Travel account</p>
    </div>

    <div class="auth-divider">
        <span>Register</span>
    </div>

    <!-- Register Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name">Full Name</label>
            <div class="input-wrapper">
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="John Doe"
                    required
                    autofocus
                    autocomplete="name"
                >
                <i class="bi bi-person"></i>
            </div>
            <x-input-error :messages="$errors->get('name')" class="input-error" />
        </div>

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
                    autocomplete="new-password"
                >
                <i class="bi bi-lock"></i>
            </div>
            <x-input-error :messages="$errors->get('password')" class="input-error" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-wrapper">
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="••••••••"
                    required
                    autocomplete="new-password"
                >
                <i class="bi bi-shield-lock"></i>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-gold">
            <i class="bi bi-person-plus"></i>
            <span>Create Account</span>
        </button>
    </form>

    <!-- Footer -->
    <div class="auth-footer">
        <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
    </div>
</x-guest-layout>
