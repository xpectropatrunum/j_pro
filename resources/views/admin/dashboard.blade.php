@extends('admin.layouts.master')

@section('title', __('admin.dashboard'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('admin.dashboard') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('admin.dashboard') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-body">
            @if (auth()->user()->hasRole('admin'))
                <h5 class="card-title">{{ __('Wellcome to admin panel') }}</h5>
            @else
            <h5 class="card-title mb-2">ورود کارمندان</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0 text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Company') }}</th>
                                <th>{{ __('Project') }}</th>
                                <th>{{ __('Login') }}</th>

                                {{--  <th>{{ __('admin.actions') }}</th>  --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                @if (
                                    $item->user->supervisor()->first()->id == auth()->user()->id && !$item->leave_time)
                                    <tr>

                                        <td>{{ $item->id }}</td>
                                        <td><a
                                                href="{{ route('admin.users.index', ['search' => $item->user_id]) }}">{{ $item->user->name }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('admin.projects.index', ['search' => $item->project->id]) }}">{{ $item->project->company_name }}</a>
                                        </td>
                                        <td><a
                                                href="{{ route('admin.projects.index', ['search' => $item->project->id]) }}">{{ $item->project->name }}</a>
                                        </td>

                                        <td>{{ (new Shamsi())->jdate($item->date . ' ' . $item->time) }} </td>
                                       
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div><!-- /.card -->
@endsection

@push('admin_css')
@endpush

@push('admin_js')
@endpush
