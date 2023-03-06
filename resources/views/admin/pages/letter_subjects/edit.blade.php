@extends('admin.layouts.master')

@section('title', __("edit letter subject"))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{__("edit letter subject")}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.letter_subjects.index') }}">{{__("List letter subjects")}}</a></li>
                <li class="breadcrumb-item active">{{__("edit letter subject")}}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/mapp.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fa/style.css') }}" />

    <style>
        #app {
            width: 100%;
            height: 500px;
        }
    </style>
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__("edit letter subject")}}</h3>
            </div>
            <form action="{{ route('admin.letter_subjects.update', $letterSubject->id) }}" method="post">
                @csrf
                @method("PUT")
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-4">
                            <label>{{__("Title_")}}</label>
                            <input type="text" value="{{ old('title', $letterSubject->title) }}" name="title"
                                class="form-control @error('title') is-invalid @enderror" required>
                        </div>
                       
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-left">
                    <button type="submit" class="submit btn btn-primary">{{ __('admin.update') }}</button>
                </div>
            </form>
            <script type="text/javascript"></script>
        </div>
        <!-- /.card -->
    </div>
    </div>
@endsection

@push('admin_css')
@endpush


