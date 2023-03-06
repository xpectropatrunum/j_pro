@extends('admin.layouts.master')

@section('title', __('admin.general_settings'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('admin.general_settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if(app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ __('admin.general_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">{{ __('Settings') }}</h5>
                </div>
                <form action="{{ route('admin.settings.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="projects">
                    <div class="card-body row">
                        <div class="form-group col-lg-6">
                            <label for="exampleInputEmail1">{{ __('End time') }}</label>
                            <input type="text" placeholder="20:00" value="{{ old('end_time', auth()->user()->setting?->end_time) }}" name="end_time" class="form-control @error('end_time') is-invalid @enderror">
                        </div>

                        <div class="form-group  col-lg-6">
                            <label for="exampleInputEmail1">{{ __('Number start from') }}</label>
                            <input type="text" value="{{ old('letter_start_from',auth()->user()->setting?->letter_start_from) }}" name="letter_start_from" class="form-control @error('letter_start_from') is-invalid @enderror">
                        </div>

                       
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('admin.apply').' '.__('admin.changes') }}</button>
                    </div>
                </form>
            </div>
        </div>

      
    </div>
@endsection

@push('admin_css')

@endpush

@push('admin_js')

@endpush
