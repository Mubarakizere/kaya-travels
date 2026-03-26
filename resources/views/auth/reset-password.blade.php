<x-guest-layout>
    <style>
        body {
            background: #0c0c0c url('{{ asset('images/why-icons-bg.png') }}') repeat;
            color: #fff;
        }

        .auth-card {
            background: rgba(0, 0, 0, 0.95);
            border-radius: 16px;
            padding: 2rem;
            max-width: 420px;
            margin: 2rem auto;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.07);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .auth-logo img {
            width: 80px;
        }

        .auth-title {
            font-size: 1.25rem;
            color: #d1af65;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1.2rem;
        }

        label {
            color: #fff;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        input[type="email"],
        input[type="password"] {
            background-color: #111;
            color: #fff;
            border: 1px solid #333;
            border-radius: 8px;
            width: 100%;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #d1af65;
            outline: none;
        }

        .text-danger {
            color: #ff6f6f;
            font-size: 0.85rem;
            margin-top: -0.5rem;
            margin-bottom: 0.75rem;
        }

        .btn-gold {
            background-color: #d1af65;
            color: #000;
            border: none;
            padding: 10px 24px;
            font-weight: 600;
            border-radius: 30px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background-color: #b89347;
            color: #fff;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 1.25rem;
                margin: 1rem auto;
            }

            .btn-gold {
                font-size: 0.95rem;
            }
        }
    </style>

    <div class="auth-card">
        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Kaya Travel & Tours Logo">
        </div>
        <div class="auth-title">Reset Your Password</div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-danger" />
            </div>

            <!-- New Password -->
            <div>
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="text-danger" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger" />
            </div>

            <div class="mt-3">
                <button type="submit" class="btn-gold">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
