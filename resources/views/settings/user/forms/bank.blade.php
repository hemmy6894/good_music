<!-- View contain variable $disabled which return '' when not decraled  -->
<div class="col-md-12">
    <div class="card border-left-success shadow py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <h1 class="h4 text-gray-900 mb-4">@lang('words.bank_info')</h1>
                <form method="POST" action="{{ route('user.update',['user' => $user->id ]) }}?bank">
                    <fieldset {{ $disabled ?? ''}} >
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="bank_name" value="{{ $user->bank_name }}" name="bank_name" class="form-control form-control-user" id="exampleBank_name" placeholder="@lang('words.enter_bank_name')">
                            @if($errors->has('bank_name'))
                                <span class="text-danger"><small>{{ $errors->first('bank_name') }}</small></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="account_name" value="{{ $user->account_name }}" name="account_name" class="form-control form-control-user" id="exampleAccount_name" placeholder="@lang('words.enter_account_name')">
                            @if($errors->has('account_name'))
                                <span class="text-danger"><small>{{ $errors->first('account_name') }}</small></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="account_no" value="{{ $user->account_no }}" name="account_no" class="form-control form-control-user" id="exampleAccount_no" placeholder="@lang('words.enter_account_no')">
                            @if($errors->has('account_no'))
                                <span class="text-danger"><small>{{ $errors->first('account_no') }}</small></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="double" value="{{ $money_view($user->basic_salary) }}" name="basic_salary" class="form-control form-control-user" id="examplebasic_salary" placeholder="@lang('words.enter_basic_salary')">
                            @if($errors->has('basic_salary'))
                                <span class="text-danger"><small>{{ $errors->first('basic_salary') }}</small></span>
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