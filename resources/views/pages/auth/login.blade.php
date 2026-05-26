@extends('layouts.auth')

@section('title', 'Login Admin - Attalas Cafe')

@section('content')
    <div class="d-flex flex-row justify-content-center align-items-center">

        {{-- LEFT SIDE --}}
        <div class="col-12 col-md-6 vh-100 d-none d-md-block" style="background: linear-gradient(135deg, #2b160d, #8b5a2b);">

            <div
                class="container p-5 d-flex flex-column justify-content-center align-items-center h-100 text-center text-white">
                <img src="{{ asset('assets/images/attalas-logo.png') }}" class="img-fluid mb-4" style="max-width: 180px;"
                    alt="Attalas Cafe Logo">

                <h1 class="fw-bold mb-2">Attalas Cafe</h1>
                <p class="mb-0 text-white-50">
                    Premium coffee, warm ambience, and modern cafe experience.
                </p>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center bg-white vh-100">
            <div class="card shadow-none border-0" style="width: 30rem;">
                <div class="card-body">

                    @if ($errors->has('failed'))
                        <div class="alert alert-warning alert-icon-start alert-dismissible fade show">
                            <span class="alert-icon bg-warning text-white">
                                <i class="ph-warning-circle"></i>
                            </span>
                            <span class="fw-semibold">Warning!</span> {{ $errors->first('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="mb-2">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/images/attalas-logo.png') }}" width="120" class="img-fluid mb-2"
                                alt="Attalas Cafe Logo">

                            <h3 class="text-center mb-0 fw-bold">Admin Panel</h3>
                            <span class="d-block text-muted text-center mb-1">
                                Attalas Cafe Management System
                            </span>
                            <span class="d-block text-muted text-center mb-3 small">
                                Login untuk mengelola menu, gallery, reviews, dan reservation
                            </span>
                        </div>

                        <form class="login-form w-100" method="POST" action="{{ route('login.process') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Username / Email</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" name="login" value="{{ old('login') }}"
                                        class="form-control @error('login') is-invalid @enderror"
                                        placeholder="Masukkan username/email" required autofocus>

                                    <div class="form-control-feedback-icon">
                                        <i class="ph-user-circle text-muted"></i>
                                    </div>

                                    @error('login')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="form-control-feedback form-control-feedback-start position-relative">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="passwordInput"
                                        placeholder="•••••••••••" required>

                                    <div class="form-control-feedback-icon start-0">
                                        <i class="ph-lock text-muted"></i>
                                    </div>

                                    <button type="button"
                                        class="btn btn-sm position-absolute end-0 top-50 translate-middle-y me-2 border-0 bg-transparent"
                                        onclick="togglePasswordVisibility()">
                                        <i class="ph-eye text-muted" id="toggleIcon"></i>
                                    </button>

                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn w-100 text-white" style="background-color: #8b5a2b;">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="text-center text-body bg-white">
                        <a href="/" class="text-body text-decoration-none"
                            style="color: rgb(152, 152, 152) !important">
                            &copy; {{ now()->year }} - Attalas Cafe
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('toggleIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ph-eye');
                icon.classList.add('ph-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('ph-eye-slash');
                icon.classList.add('ph-eye');
            }
        }
    </script>
@endsection
