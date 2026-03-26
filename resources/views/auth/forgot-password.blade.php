<x-guest-layout>
    <!-- Logo -->
    <div class="auth-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Kaya Travel & Tours">
        </a>
    </div>

    <!-- Brand -->
    <div class="auth-brand">
        <h1>Reset Password</h1>
        <p>Enter your email and we'll send you a reset link</p>
    </div>

    <div class="auth-divider">
        <span>Recover</span>
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="session-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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
                >
                <i class="bi bi-envelope"></i>
            </div>
            <x-input-error :messages="$errors->get('email')" class="input-error" />
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-gold">
            <i class="bi bi-send"></i>
            <span>Send Reset Link</span>
        </button>
    </form>

    <!-- Footer -->
    <div class="auth-footer">
        <p>Remember your password? <a href="{{ route('login') }}">Sign in</a></p>
    </div>
</x-guest-layout>
