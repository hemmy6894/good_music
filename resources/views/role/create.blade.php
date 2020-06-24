@extends('layouts.app2')
@section('content')
    <div class="col-md-8">
        <div class="card border-left-success shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <h1 class="h4 text-gray-900 mb-4">@lang('words.role')</h1>
                    <form disabled method="POST" action="{{ route('role.store') }}">
                        <fieldset {{ $disabled ?? ''}} >
                            @csrf
                            <div class="form-group">
                                <input type="name"  name="name" class="form-control form-control-user" id="exampleFirstName" placeholder="@lang('words.enter_name')">
                                @if($errors->has('name'))
                                    <span class="text-danger"><small>{{ $errors->first('name') }}</small></span>
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
@endsection