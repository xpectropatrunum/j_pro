@extends('admin.layouts.master')

@section('title', __("Edit user"))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{__("Edit user")}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb @if (app()->getLocale() == 'fa') float-sm-left @else float-sm-right @endif">
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{__("List users")}}</a></li>
                <li class="breadcrumb-item active">{{__("Edit user")}}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__("Edit user")}}</h3>
                </div>
                <form action="{{route('admin.users.update', $user->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label>{{__("ID")}}</label>
                                <input type="text" value="{{ old('system_id', $user->system_id) }}" name="system_id"
                                    class="form-control @error('system_id') is-invalid @enderror">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>{{__("Name")}}</label>
                                <input type="text" value="{{ old('name', $user->name) }}" name="name"
                                    class="form-control @error('name') is-invalid @enderror">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>{{__("Username")}}</label>
                                <input type="text" value="{{ old('username', $user->username) }}" name="username"
                                    class="form-control @error('username') is-invalid @enderror">
                            </div>
                            <div class="form-group col-lg-3">

                                <label>{{__("Email")}}</label>

                                <input type="text" value="{{ old('email', $user->email) }}" name="email"
                                    class="form-control @error('email') is-invalid @enderror">
                            </div>
                            <div class="form-group col-lg-3">
                                <label>{{__("Phone")}}</label>

                                <input type="text" value="{{ old('phone', $user->phone) }}" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror">
                            </div>
                            @if (auth()->user()->hasRole('admin'))
                            <div class="form-group col-lg-4">
                                <label>{{__("Role")}}</label>

                                <select name="roles[]" multiple class="form-control select2">
                                    @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                        <option @if ($user->hasRole($role->id)) selected @endif value="{{ $role->id }}">
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                       
                            <div class="form-group col-lg-4">
                                <label>{{__("Supervisor")}}</label>

                                <select name="supervisor" @if ($user->hasRole(["admin", "supervisor"])) disabled @endif  class="form-control ">
                                    <option>
                                       Select ...</option>
                                    @foreach ($supervisors as $supervisor)
                                        <option @if (($user->supervisor()->first()?->id ?? 0) == $supervisor->id) selected @endif value="{{ $supervisor->id }}">
                                            {{ $supervisor->name }} - {{ $supervisor->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group col-lg-3">
                                <label>{{__("Remotable")}}</label>
                                <div class="form-check">
                                    <input type="checkbox" name="remotable" class="form-check-input" value="1" id="exampleCheck2" @if(old('enabled', $user->remotable)) checked @endif>
                                    <label class="form-check-label" for="exampleCheck2">بله</label>
                                </div>
                            </div>
                           
                            <div class="form-group col-lg-3">
                                <label>{{__("Password")}}</label>
                                <input type="password" value="{{ old('password') }}" name="password" class="form-control @error('password') is-invalid @enderror" >
                            </div>
                            <div class="form-group col-lg-3">
                                <label>{{__("Password Confirm")}}</label>
                                <input type="password" value="{{ old('password_confirm') }}" name="password_confirm" class="form-control @error('password_confirm') is-invalid @enderror" >
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                    </div>

                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('admin_css')
    <link rel="stylesheet" href="{{ asset('admin-panel/libs/simplebox/simplebox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-panel/libs/miladi-datepicker/datepicker.min.css') }}">
@endpush

@push('admin_js')
    <script>
       
    </script>
@endpush
