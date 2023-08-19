@extends('layouts.app')
@section('content')
    <style>
        label.error {
            color: red;
        }
    </style>
    <form id="submitForm" method="POST" action="{{ route('register') }}" class="form w-100">
        @csrf
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input id="name" type="text" placeholder="Enter Name"
                       class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{ old('name') }}" autocomplete="name" autofocus required>

                @error('name')
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <input id="email" type="email" placeholder="Enter Email Address"
                       class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" autocomplete="email" required>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input id="password" type="password" placeholder="Enter Password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" autocomplete="new-password" required>

                @error('password')
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <input id="password-confirm" type="password" placeholder="Enter Confirm Password" class="form-control"
                       name="password_confirmation"
                       autocomplete="new-password" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option value="" selected disabled>Select a role</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                @error('role')
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                @enderror
            </div>
        </div>
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                <span class="indicator-label">Sign up</span>
                <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
            <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign
                in</a></div>
    </form>

@endsection
@push('scripts')
    <script>
        // $('#role').select2();
        if ($("#submitForm").length > 0) {
            $("#submitForm").validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password" // Match with the password field
                    },
                    role: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                    },
                    email: {
                        required: "Please enter email",
                    },
                    password: {
                        required: "Please enter password",
                    },
                    password_confirmation: {
                        required: "Please confirm password",
                        equalTo: "Passwords do not match" // Custom error message for mismatch
                    },
                    role: {
                        required: "Please select role",
                    },
                },
            });
        }

    </script>
@endpush
