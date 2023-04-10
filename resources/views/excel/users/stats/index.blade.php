<table class="table table-striped table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <th>{{ __('Worker') }}</th>
            <th>{{ $user->name }}</th>

        </tr>
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
                $times_ = 0;
                foreach ($logs->get() as $log) {
                    $companies[] = $log->company?->company_name;
                    $times_ += $log->duration_in_seconds;
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
                        {{ explode(' ', $logs->latest()->first()->leave_time)[1] ?? $logs->latest()->first()->leave_time }}
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
                    {{ gmdate('H:i', $times_) }}
                </td>

            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>
                {{ number_format($fees) }}
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                {{ gmdate('d', $times) > 1 ? gmdate('d', $times) . ' روز' : '' }} {{ gmdate('H:i', $times) }}
            </td>

        </tr>
    </tbody>
</table>
