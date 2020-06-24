@extends('layouts.app2')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h4 text-gray-900 mb-4">@lang('words.register_user')</h1>
                        <form method="POST" action="{{ route('user.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="first_name" name="first_name" class="form-control form-control-user" id="exampleFirstName" placeholder="@lang('words.enter_first_name')">
                                @if($errors->has('first_name'))
                                    <span class="text-danger"><small>{{ $errors->first('first_name') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="last_name" name="last_name" class="form-control form-control-user" id="exampleLastName" placeholder="@lang('words.enter_last_name')">
                                @if($errors->has('last_name'))
                                    <span class="text-danger"><small>{{ $errors->first('last_name') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="surname" name="surname" class="form-control form-control-user" id="exampleSurname" placeholder="@lang('words.enter_surname')">
                                @if($errors->has('surname'))
                                    <span class="text-danger"><small>{{ $errors->first('surname') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" id="exampleEmail" placeholder="@lang('words.enter_email')">
                                @if($errors->has('email'))
                                    <span class="text-danger"><small>{{ $errors->first('email') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="department" class="form-control form-control-user" id="departments">
                                    <option value="{{ NULL }}">@lang('words.select_departments')</option>
                                    @foreach($departments as $department)
                                        <option  value="{{ $department->id }}"> {{ $department->name }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('department'))
                                    <span class="text-danger"><small>{{ $errors->first('department') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="gender" class="form-control form-control-user" id="gender">
                                    <option value="{{ NULL }}"> @lang('words.select_genders') </option>
                                    @foreach($genders as $gender)
                                        <option  value="{{ $gender->id }}"> {{ $gender->name }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('gender'))
                                    <span class="text-danger"><small>{{ $errors->first('gender') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="status" class="form-control form-control-user" id="status">
                                    <option value="{{ NULL }}"> @lang('words.select_status')</option>
                                    @foreach($statuses as $status)
                                        <option  value="{{ $status->id }}"> {{ $status->name }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('status'))
                                    <span class="text-danger"><small>{{ $errors->first('status') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="role" class="form-control form-control-user" id="role">
                                    <option value="{{ NULL }}"> @lang('words.select_role')</option>
                                    @foreach($roles as $role)
                                        <option  value="{{ $role->id }}"> {{ $role->role_name }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('role'))
                                    <span class="text-danger"><small>{{ $errors->first('role') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="@lang('words.enter_password')">
                                @if($errors->has('password'))
                                    <span class="text-danger"><small>{{ $errors->first('password') }}</small></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary btn-icon-split pull-right">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">@lang('words.btn_submit')</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection