@extends('user::layouts.main')

@section('headers')
    <link rel="stylesheet" href="{{ Module::asset('user:datatables/datatables.min.css') }}" />
    <style>
        .dataTables_wrapper {
            padding: 10px 10px; 
        }
    </style>
@endsection

@section('content')
    <div class="title">
        <h2 class="title__main diline">
            <span class="title__icon-float text-info">
                <span class="icon-add_circle"></span>
            </span>
            Update Permission
        </h2>
    </div>
    <div class="section">
        {{ Form::model($permission, ['method' => 'PUT', 'route' => ['permissions.update', $permission->id]]) }}
        <div class="form__block form__block--half clearfix pt20">
            <div class="form__block-item">
                {{ Form::label('name', 'Permission*', ['class' => 'form__block-label']) }}
                <div class="form__wrap">
                    {{ Form::text('name', null, ['class' => 'df__input', 'placeholder' => 'type permission name', 'required' => '']) }}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="form__block-item col-3">
            {{ Form::submit('Update', ['class' => 'btn btn-info']) }}
            <a href="{{ route('permissions.index') }}"><span class='btn btn-default'>Cancel</span></a>
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('js-sources')
    <script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/moment.min.js') }}"></script>
@endsection