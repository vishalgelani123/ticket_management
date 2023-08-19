@extends('backend.layouts.app')
@section('title') Profile @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-right">
                            <div class="card-title"><span class="fa fa-photo-film"></span> &nbsp;Profile Settings</div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <img class="rounded-circle mt-5" width="100px" height="100px"
                                         src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="">
                                    <span class="font-weight-bold mt-4">{{ Auth::user()->name }}</span>
                                    <span class="text-black-50">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="p-3 py-5">
                                    <form id="profileForm" action="{{ route('profile.update') }}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name"
                                                   value="{{ Auth::user()->name }}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" value="{{ Auth::user()->email }}"
                                                   name="email">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password">
                                            <span class="text-danger">Leave blank if you don't want to change</span>
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary mt-2" id="createSubmit" type="button">Update
                                            Profile
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#profileForm');
            const createSubmitButton = document.querySelector('#createSubmit');

            createSubmitButton.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default button behavior
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to submit the form.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function () {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Form submitted successfully.',
                                icon: 'success',
                                confirmButtonColor: '#3085d6'
                            });
                            form.submit();
                        }, 1000);
                    }
                });
            });
        });
    </script>
@endpush
