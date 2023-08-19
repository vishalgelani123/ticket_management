@extends('backend.layouts.app')
@section('title') Create User @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="fa fa-user"></span>&nbsp;Create User</div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="label">Name</label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="label">Email</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="password" class="label">Password</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           value="{{ old('password') }}">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="role" class="label">Role</label>
                                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="" selected disabled>Select a role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mt-2">
                                <button type="submit" id="createSubmit" class="btn btn-primary col-md-1 m-2">
                                    {{ __('Submit') }}
                                </button>
                                <a class="btn btn-danger text-white col-md-1 m-2" href="{{route('users.index')}}">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#role').select2();
    </script>
@endpush
