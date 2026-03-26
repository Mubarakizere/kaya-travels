<x-guest-layout>
    <!-- Logo -->
    <div class="auth-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Kaya Travel & Tours">
        </a>
    </div>

    <!-- Brand -->
    <div class="auth-brand">
        <h1>Email Verification</h1>
        <p>One more step to get started</p>
    </div>

    <div class="auth-divider">
        <span>Verify</span>
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="session-status" style="background: rgba(42,157,92,0.08); border-color: rgba(42,157,92,0.2); color: #2a9d5c;">
            <i class="bi bi-check-circle me-1"></i>
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div style="text-align: center; margin-bottom: 1.5rem;">
        <div style="width: 64px; height: 64px; background: rgba(201,162,39,0.1); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
            <i class="bi bi-envelope-check" style="font-size: 1.75rem; color: #c9a227;"></i>
        </div>
        <p style="color: #6b6358; font-size: 0.9rem; line-height: 1.6;">
            Thanks for signing up! Please verify your email by clicking the link we sent you.
            <br>If you didn't receive the email, click below to get a new one.
        </p>
    </div>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn-gold">
            <i class="bi bi-send"></i>
            <span>Resend Verification Email</span>
        </button>
    </form>

    <!-- Footer -->
    <div class="auth-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background: none; border: none; color: #a8871e; font-size: 0.85rem; font-weight: 500; cursor: pointer;">
                <i class="bi bi-box-arrow-left me-1"></i>Logout
            </button>
        </form>
    </div>
</x-guest-layout>
