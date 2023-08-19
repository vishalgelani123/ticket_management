@extends('backend.layouts.app')
@section('title') Create Ticket @endsection
@section('content')
    <style>
        label.error {
            color: red;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="fa fa-ticket"></span>&nbsp;Create Ticket</div>
                    </div>
                    <div class="card-body">
                        <form id="submitForm" method="post" action="{{ route('tickets.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row ">
                                <div class="col-md-6 mx-auto">
                                    <label for="title" class="label">Title</label>
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') }}" required>
                                    @error('title')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 mx-auto">
                                    <label for="description" class="label">Description</label>
                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 mx-auto">
                                    <label for="category" class="label">Category</label>
                                    <select name="category" id="category"
                                            class="form-control @error('category') is-invalid @enderror" required>
                                        <option value="" selected disabled>Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 mx-auto">
                                    <button type="submit" id="createSubmit" class="btn btn-primary  m-2">
                                        {{ __('Submit') }}
                                    </button>
                                    <a class="btn btn-danger text-white   m-2" href="{{route('tickets.index')}}">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
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
        $('#category').select2();
        if ($("#submitForm").length > 0) {
            $("#submitForm").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 255
                    },
                    category: {
                        required: true,
                        maxlength: 255
                    },
                    description: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: "Please enter title",
                    },
                    category: {
                        required: "Please select a category", // Updated error message
                    },
                    description: {
                        required: "Please enter description",
                    },
                },
                errorPlacement: function (error, element) {
                    if (element.is("select")) {
                        error.insertAfter(element.next()); // Display error next to the select element
                    } else {
                        error.insertAfter(element); // Display error after other fields
                    }
                },
            });
        }

    </script>
@endpush
