@extends('layouts.app')
@section('content')
    <style>
        label.error {
            color: red;
        }
    </style>
    <form id="submitForm" method="POST" action="{{ route('login') }}" class="form w-100">
        @csrf
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" placeholder="Enter Email Address" autocomplete="email" autofocus
                       required>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror" name="password"
                       autocomplete="current-password" placeholder="Enter password" required>

                @error('password')
                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                @enderror
            </div>
        </div>
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>
            <a href="{{ route('password.request') }}"
               class="link-primary">Forgot Password ?</a>
        </div>
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <span class="indicator-label">Sign In</span>
                <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
            <a href="{{ route('register') }}" class="link-primary">Sign
                up</a></div>
    </form>
@endsection
@push('scripts')
    <script>
        if ($("#submitForm").length > 0) {
            $("#submitForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                },
                messages: {
                    email: {
                        required: "Please enter email",
                    },
                    password: {
                        required: "Please enter password",
                    },
                },
            });
        }

    </script>
@endpush
