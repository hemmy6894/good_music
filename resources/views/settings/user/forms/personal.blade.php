<!-- View contain variable $disabled which return '' when not decraled  -->
<div class="col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h1 class="h4 text-gray-900 mb-4">@lang('words.personal_info')</h1>
                        <form method="POST" action="{{ route('user.update',['user' => $user->id ]) }}">
                            <fieldset {{ $disabled ?? ''}} >
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="first_name"  value="{{ $user->fname }}" name="first_name" class="form-control form-control-user" id="exampleFirstName" placeholder="@lang('words.enter_first_name')">
                                    @if($errors->has('first_name'))
                                        <span class="text-danger"><small>{{ $errors->first('first_name') }}</small></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="last_name" value="{{ $user->lname }}" name="last_name" class="form-control form-control-user" id="exampleLastName" placeholder="@lang('words.enter_last_name')">
                                    @if($errors->has('last_name'))
                                        <span class="text-danger"><small>{{ $errors->first('last_name') }}</small></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="surname" name="surname" value="{{ $user->sname }}" class="form-control form-control-user" id="exampleSurname" placeholder="@lang('words.enter_surname')">
                                    @if($errors->has('surname'))
                                        <span class="text-danger"><small>{{ $errors->first('surname') }}</small></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control form-control-user" id="exampleEmail" placeholder="@lang('words.enter_email')">
                                    @if($errors->has('email'))
                                        <span class="text-danger"><small>{{ $errors->first('email') }}</small></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="phone" name="phone" value="{{ $user->phone }}" class="form-control form-control-user" id="examplePhone" placeholder="@lang('words.enter_phone')">
                                    @if($errors->has('phone'))
                                        <span class="text-danger"><small>{{ $errors->first('phone') }}</small></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="date" name="dob" value="{{ $user->dob }}" class="form-control form-control-user" id="exampleDob" placeholder="@lang('words.enter_dob')">
                                    @if($errors->has('dob'))
                                        <span class="text-danger"><small>{{ $errors->first('dob') }}</small></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <select name="department" class="form-control form-control-user" id="departments">
                                        <option value="{{ NULL }}">@lang('words.select_departments')</option>
                                        @foreach($departments as $department)
                                            <option @if($user->department_id == $department->id) selected @endif value="{{ $department->id }}"> {{ $department->name }} </option>
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
                                            <option @if($user->gender == $gender->id) selected  @endif value="{{ $gender->id }}"> {{ $gender->name }} </option>
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
                                            <option @if($user->employee_status == $status->id) selected @endif value="{{ $status->id }}"> {{ $status->name }} </option>
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
                                            <option @if($user->roles == $role->id) selected  @endif value="{{ $role->id }}"> {{ $role->role_name }} </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('role'))
                                        <span class="text-danger"><small>{{ $errors->first('role') }}</small></span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <textarea  name="post_address" class="form-control form-control-user" id="exampleEmail" placeholder="@lang('words.enter_post_address')">{{ $user->post_address }}</textarea>
                                    @if($errors->has('post_address'))
                                        <span class="text-danger"><small>{{ $errors->first('post_address') }}</small></span>
                                    @endif
                                </div>
                                @if(($disabled ?? '') != 'disabled')
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary btn-icon-split pull-right">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-arrow-right"></i>
                                            </span>
                                            <span class="text">@lang('words.btn_update')</span>
                                        </button>
                                    </div>
                                @endif
                            </fieldset>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>