@extends('backend.layouts.app')
@section('title') Leads @endsection
@section('content')
    <style>
        .btn-info {
            display: none;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif
            </div>

            <div class="col-12">
                <a href="{{route('users.create')}}" class="btn btn-primary float-end">Create Lead</a>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="fa fa-user"></span>&nbsp;Leads</div>
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! $dataTable->scripts() !!}

@endpush
