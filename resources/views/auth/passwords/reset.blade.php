@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('password.update') }}" class="form w-100">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark fw-bolder mb-3">Setup New Password</h1>
            <div class="text-gray-500 fw-semibold fs-6">Have you already reset the password ?
                <a href="{{ route('login') }}" class="link-primary fw-bold">Sign
                    in</a></div>
        </div>
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="row mb-3">
            <div class="col-md-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly
                       style="background: lightsteelblue">

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
                       name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <input id="password-confirm" placeholder="Enter Confirm Password" type="password" class="form-control"
                       name="password_confirmation" required
                       autocomplete="new-password">
            </div>
        </div>

        <div class="d-grid mb-10">
            <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
@endsection
