<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('auth-title', 'Account') - Kaya Travel & Tours</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --gold: #c9a227;
            --gold-dark: #a8871e;
            --gold-light: #e8d48b;
            --cream: #faf8f4;
            --sand: #f3efe7;
            --warm-gray: #6b6358;
            --text-dark: #2c2820;
            --text-muted: #8a8278;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Soft background pattern */
        .auth-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 120% 80% at 30% 20%, rgba(201,162,39,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 80% 100% at 80% 80%, rgba(201,162,39,0.04) 0%, transparent 60%),
                var(--cream);
        }

        /* Decorative circles */
        .auth-bg::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            border: 1px solid rgba(201,162,39,0.08);
            top: -150px;
            right: -100px;
        }

        .auth-bg::after {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            border: 1px solid rgba(201,162,39,0.06);
            bottom: -80px;
            left: -80px;
        }

        /* Main container */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            position: relative;
            z-index: 1;
        }

        /* Card */
        .auth-card {
            background: #fff;
            border: 1px solid rgba(201,162,39,0.12);
            border-radius: 20px;
            padding: 2.5rem 2.5rem 2rem;
            max-width: 440px;
            width: 100%;
            position: relative;
            box-shadow:
                0 4px 24px rgba(0,0,0,0.04),
                0 1px 4px rgba(0,0,0,0.02);
            animation: cardEntry 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardEntry {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Top accent line */
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            border-radius: 0 0 4px 4px;
        }

        /* Logo */
        .auth-logo {
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .auth-logo img {
            width: 80px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .auth-logo img:hover {
            transform: scale(1.06);
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .auth-brand h1 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .auth-brand p {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Divider */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201,162,39,0.2), transparent);
        }

        .auth-divider span {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* Form groups */
        .form-group {
            margin-bottom: 1.15rem;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--warm-gray);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.4rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 1rem;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="text"],
        .form-group input[type="tel"] {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.6rem;
            background: var(--sand);
            border: 1.5px solid rgba(0,0,0,0.06);
            border-radius: 12px;
            color: var(--text-dark);
            font-size: 0.93rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input:hover {
            border-color: rgba(201,162,39,0.3);
        }

        .form-group input:focus {
            border-color: var(--gold);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(201,162,39,0.1);
        }

        .input-wrapper:has(input:focus) i {
            color: var(--gold);
        }

        .form-group input::placeholder {
            color: #bbb;
        }

        /* Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .form-check input[type="checkbox"] {
            width: 17px !important;
            height: 17px;
            accent-color: var(--gold);
            border-radius: 4px;
            cursor: pointer;
        }

        .form-check label {
            font-size: 0.85rem;
            color: var(--text-muted) !important;
            cursor: pointer;
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0;
        }

        /* Links */
        .auth-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .auth-links a {
            font-size: 0.84rem;
            color: var(--gold-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-links a:hover { color: var(--gold); }

        /* Submit */
        .btn-gold {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.9rem 2rem;
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(201,162,39,0.25);
        }

        .btn-gold:active { transform: translateY(0); }

        /* Errors */
        .input-error { color: #d44 !important; font-size: 0.8rem; margin-top: 0.3rem; display: block; }
        .input-error p { margin: 0; color: #d44; font-size: 0.8rem; }

        /* Session status */
        .session-status {
            background: rgba(201,162,39,0.08);
            border: 1px solid rgba(201,162,39,0.2);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: var(--gold-dark);
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            text-align: center;
        }

        /* Footer */
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .auth-footer p {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .auth-footer a {
            color: var(--gold-dark);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover { color: var(--gold); }

        @media (max-width: 480px) {
            .auth-card { padding: 2rem 1.5rem 1.5rem; border-radius: 16px; }
            .auth-brand h1 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>
    <div class="auth-bg"></div>

    <div class="auth-wrapper">
        <div class="auth-card">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
