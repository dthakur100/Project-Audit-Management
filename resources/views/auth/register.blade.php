@extends('layouts.app')

@section('content')
<style>
    .login-card {
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    background: #ffffff;
}

.login-underline {
    width: 70px;
    height: 4px;
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    border-radius: 4px;
    margin-top: 8px;
}

.login-card .form-control {
    border-radius: 10px;
    padding: 12px 14px;
}

.btn-animated {
    transition: all 0.25s ease;
}

.btn-animated:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}

</style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">

            <div class="card login-card border-0">
                <div class="card-body p-4">

                    <!-- Title -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-1">Create Account</h4>
                        <p class="text-muted small">
                            Register to Audit Management Tool
                        </p>
                        <div class="login-underline mx-auto"></div>
                    </div>

                    <!-- Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger py-2">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input name="name"
                                   class="form-control form-control-lg"
                                   placeholder="Your name"
                                   value="{{ old('name') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email"
                                   name="email"
                                   class="form-control form-control-lg"
                                   placeholder="you@example.com"
                                   value="{{ old('email') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg"
                                   placeholder="Minimum 6 characters"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control form-control-lg"
                                   placeholder="Re-enter password"
                                   required>
                        </div>

                        <button class="btn btn-success w-100 btn-lg btn-animated">
                            Create Account
                        </button>
                    </form>

                    <!-- Footer -->
                    <div class="text-center mt-4">
                        <p class="small mb-0">
                            Already have an account?
                            <a href="{{ route('login') }}" class="fw-semibold">
                                Login
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
