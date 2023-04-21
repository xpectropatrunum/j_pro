@extends('admin.layouts.master')

@section('title', __('Leaves'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Leaves') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Leaves') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header d-flex align-items-center px-3">
                    <h3 class="card-title">{{ __('Leaves') }}</h3>
                </div>
                <div class="card-body p-3">
                    <form class="frm-filter" action="{{ route('admin.leaves.index') }}" type="post" autocomplete="off">
                        @csrf

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="input-group input-group-sm" style="width: 70px;">
                                <select name="limit" class="custom-select">
                                    <option value="10" @if ($limit == 10) selected @endif>10</option>
                                    <option value="25" @if ($limit == 25) selected @endif>25</option>
                                    <option value="50" @if ($limit == 50) selected @endif>50</option>
                                    <option value="100" @if ($limit == 100) selected @endif>100</option>
                                    <option value="200" @if ($limit == 200) selected @endif>200</option>
                                </select>
                            </div>

                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" name="search" class="form-control"
                                    placeholder="{{ __('admin.search') }}..." value="{{ $search }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0 text-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Company') }}</th>
                                    <th>{{ __('Project') }}</th>
                                    <th>{{ __('Login') }}</th>
                                    <th>{{ __('Logout') }}</th>
                                    <th>{{ __('Transfer fee') }}</th>
                                    <th>{{ __('Note') }}</th>
                                    {{--  <th>{{ __('admin.actions') }}</th>  --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    @if ($item->log)
                                        <tr>
                                            <td><a
                                                    href="{{ route('admin.users.index', ['search' => $item->log->user_id]) }}">{{ $item->log->user->name }}</a>
                                            </td>
                                            <td><a
                                                href="{{ route('admin.projects.index', ['search' => $item->log->company?->id]) }}">{{ $item->log->company?->company_name }}</a>
                                        </td>
                                            <td><a
                                                    href="{{ route('admin.projects.index', ['search' => $item->log->project?->id]) }}">{{ $item->log->project?->name }}</a>
                                            </td>

                                            <td>{{ (new Shamsi())->jdate($item->log->date . ' ' . $item->log->time) }}</td>
                                            <td>{{ $item->log->leave_time ? (new Shamsi())->jdate($item->log->leave_time):"--"  }}
                                            </td>

                                            <td>{{ number_format($item->fee ?: 0) }}</td>
                                            <td><a href="#" data-toggle="tooltip" title="{{$item->note}}">{{ strlen($item->note) > 20 ? mb_substr($item->note, 0, 20) . ".." : $item->note}}</a></td>

                                            {{--  <td class="project-actions">
                                  

                                    <form action="{{ route('admin.letters.destroy',$item->id) }}" class="d-inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="swalConfirmDelete(this)" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                            {{ __('admin.delete') }}
                                        </button>
                                    </form>
                                </td>  --}}
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="cart-footer p-3 d-block d-md-flex justify-content-between align-items-center border-top">
                    {{ $items->onEachSide(0)->links('admin.partials.pagination') }}

                    <p class="text-center mb-0">
                        {{ __('admin.display') . ' ' . $items->firstItem() . ' ' . __('admin.to') . ' ' . $items->lastItem() . ' ' . __('admin.from') . ' ' . $items->total() . ' ' . __('admin.rows') }}
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('admin_css')
@endpush

@push('admin_js')
    <script>
        $(function() {
            $('.changeStatus').on('change', function() {
                id = $(this).attr('data-id');
                key = $(this).attr('data-key');

                if ($(this).is(':checked')) {
                    status = 1;
                } else {
                    status = 0;
                }

                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'post',
                    data: {
                        enable: status,
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        // $("#beforeAfterLoading").addClass("spinner-border");
                    },
                    complete: function() {
                        // $("#beforeAfterLoading").removeClass("spinner-border");
                    },
                    success: function(res) {
                        Toast.fire({
                            icon: 'success',
                            'title': 'Record status successfully changed'
                        })
                    }
                });
            });
        });
    </script>
@endpush
