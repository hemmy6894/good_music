<!-- View contain variable $disabled which return '' when not decraled  -->
<div class="col-md-12">
    <div class="card border-left-success shadow py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <h1 class="h4 text-gray-900 mb-4">@lang('words.ids_info')</h1>
                <form disabled method="POST" action="{{ route('user.update',['user' => $user->id ]) }}?ids">
                    <fieldset {{ $disabled ?? ''}} >
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="employee_no" value="{{ $user->employee_no }}" name="employee_no" class="form-control form-control-user" id="exampleFirstName" placeholder="@lang('words.enter_employee_no')">
                            @if($errors->has('employee_no'))
                                <span class="text-danger"><small>{{ $errors->first('employee_no') }}</small></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="pension_no" value="{{ $user->pension_no }}" name="pension_no" class="form-control form-control-user" id="exampleLastName" placeholder="@lang('words.enter_pension_no')">
                            @if($errors->has('pension_no'))
                                <span class="text-danger"><small>{{ $errors->first('pension_no') }}</small></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="date" value="{{ $user->joined_date }}" name="joined_date" class="form-control form-control-user" id="exampleLastName" placeholder="@lang('words.enter_joined_date')">
                            @if($errors->has('joined_date'))
                                <span class="text-danger"><small>{{ $errors->first('joined_date') }}</small></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="national_id" value="{{ $user->national_id }}" name="national_id" class="form-control form-control-user" id="examplenational_id" placeholder="@lang('words.enter_national_id')">
                            @if($errors->has('national_id'))
                                <span class="text-danger"><small>{{ $errors->first('national_id') }}</small></span>
                            @endif
                        </div>
                        @if(($disabled ?? '') != 'disabled')
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary btn-icon-split pull-right">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-arrow-right"></i>
                                    </span>
                                    <span class="text">@lang('words.btn_submit')</span>
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