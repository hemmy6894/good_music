@extends('layouts.app2')
@section('content')
    <div class="row">
        @include('settings.user.forms.personal')
        <div class="col-md-6">
            @include('settings.user.forms.ids')
            <br />
            @include('settings.user.forms.bank')
        </div>
    </div>
@endsection