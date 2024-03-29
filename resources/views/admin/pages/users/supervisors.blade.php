@extends('admin.layouts.master')

@section('title', __('Supervisors'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark"> @role('supervisor')
                    {{ __('Workers') }}
                @endrole
                @role('admin')
                    {{ __('Supervisors') }}
                @endrole
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active"> @role('supervisor')
                        {{ __('Workers') }}
                    @endrole
                    @role('admin')
                        {{ __('Supervisors') }}
                    @endrole
                </li>
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
                    <h3 class="card-title"> @role('supervisor')
                            {{ __('Workers') }}
                        @endrole
                        @role('admin')
                            {{ __('Supervisors') }}
                        @endrole
                    </h3>

                </div>
                <div class="card-body p-3">
                    <form class="frm-filter" action="{{ route('admin.users.index') }}" type="post" autocomplete="off">
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
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    @if (auth()->user()->hasRole('supervisor'))
                                        <th>{{ __('Remotable') }}</th>
                                    @else
                                        <th>{{ __('Roles') }}</th>
                                    @endif
                                    <th>{{ __('Enable') }}</th>
                                    <th>{{ __('Created Date') }}</th>
                                    <th>{{ __('Actions') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    @if ($item->hasRole('supervisor'))
                                        <tr>
                                           
                                            <td>{{ $item->system_id }}</td>

                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                @foreach ($item->getRoleNames() as $role)
                                                    <a
                                                        href="/admin/roles?search={{ $role }}">{{ $role }}</a><br>
                                                @endforeach

                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox"
                                                        data-url="{{ route('admin.users.status', $item->id) }}"
                                                        data-id="{{ $item->id }}" class="form-check-input changeStatus"
                                                        id="exampleCheck{{ $item->id }}"
                                                        @if ($item->enable) checked @endif>
                                                    <label class="form-check-label" for="exampleCheck{{ $item->id }}">
                                                        {{ __('enable') }} </label>
                                                </div>
                                            </td>
                                            <td>{{ (new Shamsi())->jdate($item->created_at, true) }}</td>

                                            <td class="project-actions">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.users.edit', $item->id) }}">
                                                    <i class="fas fa-pen"></i>
                                                    {{ __('Edit') }}
                                                </a>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('admin.users.index', ["supervisor" => $item->id]) }}">
                                                    <i class="fas fa-user"></i>
                                                    {{ __('Workers') }}
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $item->id) }}"
                                                    class="d-inline-block" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="swalConfirmDelete(this)"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                        {{ __('admin.delete') }}
                                                    </button>
                                                </form>


                                            </td>

                                        </tr>

                                    @endrole
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

            if ($(this).is(':checked')) {
                enable = 1;
            } else {
                enable = 0;
            }

            $.ajax({
                url: $(this).attr('data-url'),
                type: 'post',
                data: {
                    'enable': enable,
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
                        'title': "{{ __('Record status successfully changed') }}"
                    })
                }
            });
        });
        $('.changeStatus2').on('change', function() {
            id = $(this).attr('data-id');

            if ($(this).is(':checked')) {
                enable = 1;
            } else {
                enable = 0;
            }

            $.ajax({
                url: $(this).attr('data-url'),
                type: 'post',
                data: {
                    'remotable': enable,
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
                        'title': "{{ __('Record status successfully changed') }}"
                    })
                }
            });
        });
    });
</script>
@endpush
