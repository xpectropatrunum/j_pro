<table class="table table-striped table-bordered mb-0 text-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('Title_') }}</th>
            <th>{{ __('Number') }}</th>
            <th>{{ __('Company') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('User') }}</th>
            {{--  <th>{{ __('admin.created_date') }}</th>  --}}
            {{--  <th>{{ __('admin.actions') }}</th>  --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->letter_subject?->title ?? '--' }}</td>
                <td>{{ $item->number }}</td>
                <td>{{ $item->project?->company_name }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->user->name }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
