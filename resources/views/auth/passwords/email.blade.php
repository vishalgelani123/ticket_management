@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('password.email') }}" class="form w-100">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
            <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input id="email" type="email" placeholder="Email Address"
                       class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                @enderror
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center pb-lg-0 mt-5">
            <button type="submit" class="btn btn-primary me-4">
                <span class="indicator-label">Send Password Reset Link</span>
                <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
@endsection
