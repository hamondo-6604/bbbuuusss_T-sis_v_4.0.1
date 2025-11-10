<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('form/login/css/style.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-card">

            @include('message')

            <div class="login-header">
                <div class="logo">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                        <rect width="36" height="36" rx="8" fill="#6366F1"/>
                        <path d="M12 14h12v8H12v-8zm2 2v4h8v-4h-8zm-2-4h12v2H12v-2zm0 12h12v2H12v-2z" fill="white"/>
                    </svg>
                </div>
                <h1>SecureBus</h1>
                <p>Create your account securely</p>
            </div>

            <form action="{{ route('register_post') }}" method="post" class="login-form" id="registerForm">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" id="name" required autocomplete="name">
                    <span class="error-message" id="nameError"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" id="email" required autocomplete="email">
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="new-password">
                        <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                            <svg class="eye-open" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M9 3.75C5.25 3.75 2.04 6.24 1.5 9c.54 2.76 3.75 5.25 7.5 5.25s6.96-2.49 7.5-5.25c-.54-2.76-3.75-5.25-7.5-5.25zm0 8.75a3.5 3.5 0 110-7 3.5 3.5 0 010 7zm0-5.5a2 2 0 100 4 2 2 0 000-4z" fill="currentColor"/>
                            </svg>
                            <svg class="eye-closed" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M2.25 2.25l13.5 13.5m-4.125-4.125a3 3 0 01-4.243-4.243m4.243 4.243L9 9m2.625 2.625L15 15M9 5.25c1.83 0 3.51.63 4.84 1.68M3.16 6.93A10.97 10.97 0 019 5.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                        <button type="button" class="password-toggle" id="confirmPasswordToggle" aria-label="Toggle password visibility">
                            <svg class="eye-open" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M9 3.75C5.25 3.75 2.04 6.24 1.5 9c.54 2.76 3.75 5.25 7.5 5.25s6.96-2.49 7.5-5.25c-.54-2.76-3.75-5.25-7.5-5.25zm0 8.75a3.5 3.5 0 110-7 3.5 3.5 0 010 7zm0-5.5a2 2 0 100 4 2 2 0 000-4z" fill="currentColor"/>
                            </svg>
                            <svg class="eye-closed" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M2.25 2.25l13.5 13.5m-4.125-4.125a3 3 0 01-4.243-4.243m4.243 4.243L9 9m2.625 2.625L15 15M9 5.25c1.83 0 3.51.63 4.84 1.68M3.16 6.93A10.97 10.97 0 019 5.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    <span class="error-message" id="confirmPasswordError"></span>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Register</span>
                    <div class="btn-loader">
                        <div class="spinner"></div>
                    </div>
                </button>
            </form>

            <div class="security-notice">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8 1L3 3v4.5c0 2.89 2 5.5 5 6 3-0.5 5-3.11 5-6V3l-5-2z" stroke="#10B981" stroke-width="1.5" fill="none"/>
                    <path d="M6 8l1.5 1.5L11 6" stroke="#10B981" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Your connection is secured with 256-bit SSL encryption</span>
            </div>

        </div>
    </div>

    {{-- <script src="../../shared/js/form-utils.js"></script>
    <script src="{{ asset('form/login/js/script.js') }}"></script> --}}
</body>
</html>
