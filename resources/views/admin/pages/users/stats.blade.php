@extends('admin.layouts.master')

@section('title', __('Worker stats'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Worker stats') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Worker stats') }}</li>
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
                    <h3 class="card-title">کارمند {{ $user->name }}</h3>
                </div>

                <div class="card-body p-3">

                    <div class="row">
                        <div class="col-md-2 col-12 form-group ">
                            <label for="year">سال</label>
                            <select name="year" class="form-control">
                                @foreach (MyHelper::years() as $key => $item)
                                    <option  @if((request()->year?? (new Shamsi)->jNumber()[0] ) == $item ) selected @endif value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-12 form-group ">
                            <label for="month">ماه</label>
                            <select name="month" class="form-control">
                                @foreach (MyHelper::months() as $key => $item)
                                    <option @if((request()->month?? (new Shamsi)->jNumber()[1] ) == $key + 1) selected @endif value="{{ $key + 1 }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                      

                    </div>
                    <div class="mb-4">
                        <a href="javascript:{}" class="search-performance"><button type="button"
                            class="btn btn-outline-info">جستجو</button></a>
                    </div>
                    مجموع ساعات کاری:                {{ MyHelper::standardDuration($times)}} 


                    <a href="{{ route('admin.users.stats.excel', ["user" => $user->id, "year" => request()->year, "month" => request()->month]) }}"><button type="button"
                            class="btn btn-primary">{{ __('Download Excel') }}</button></a>

                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered mb-0 text-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Weekday') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Login') }}</th>
                                    <th>{{ __('Logout') }}</th>
                                    <th>{{ __('Off') }}</th>
                                    <th>{{ __('Transfer fee') }}</th>
                                    <th>{{ __('Company 1') }}</th>
                                    <th>{{ __('Company 2') }}</th>
                                    <th>{{ __('Company 3') }}</th>
                                    <th>{{ __('Company 4') }}</th>
                                    <th>{{ __('Duration') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($dates as $item)
                                    @php
                                        $logs = $user
                                            ->logs()
                                            ->where(DB::raw('UNIX_TIMESTAMP(date)'), $item->unix)
                                            ;
                                        
                                        $leaves = $user
                                            ->leaves()
                                            ->where('leaves.created_at', $item->date)
                                            ->get();
                                        
                                        $off = $user
                                            ->offs()
                                            ->where(DB::raw('(date)'), $item->date)
                                            ->first();
                                        $companies = [];
                                        $times = 0;
                                        foreach ($logs->get() as $log) {
                                            $companies[] = $log->company?->company_name;
                                            $times += $log->duration_in_seconds;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->weekday }}</td>
                                        <td>
                                            @if ($item->index == 5 || $item->index == 4)
                                                تعطیل
                                            @elseif($logs->first())
                                                ✔️
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$logs->first())
                                                --
                                            @else
                                                {{ $logs->first()->time }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($logs->first())
                                                {{ explode(" ", $logs->latest()->first()->leave_time)[1] ?? $logs->latest()->first()->leave_time }}
                                            @elseif (!$leaves->first())
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$off)
                                                --
                                            @else
                                                {{ $off->time ?: 'یک روز' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $logs->first()?->leave ? ($logs->first()->leave->fee > 0 ? number_format($logs->first()->leave->fee) : '--') : '--' }}

                                        </td>
                                        <td>
                                            {{ $companies[0] ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $companies[1] ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $companies[2] ?? '--' }}
                                        </td>
                                        <td>
                                            {{ $companies[3] ?? '--' }}
                                        </td>
                                        <td>
                                            {{ gmdate('H:i', $times) }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            $(".search-performance").click(function(){
                window.location.href = "stats?month=" + $("[name=month]").val() + "&year=" + $("[name=year]").val();
            })
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
                        [key]: status,
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
