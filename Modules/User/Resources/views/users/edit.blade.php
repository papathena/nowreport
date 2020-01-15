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
            Update User
        </h2>
    </div>
    <div class="section">
        {{ Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id]]) }}
        <div class="form__block form__block--half clearfix pt20">
            <div class="form__block-item">
                {{ Form::label('name', 'Role*', ['class' => 'form__block-label']) }}
                <div class="form__wrap">
                    {{ Form::text('name', null, ['class' => 'df__input', 'placeholder' => 'type role name', 'required' => '', 'disabled' => 'disable']) }}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="form__block-item">
                {{ Form::label('assign', 'Assign Roles', ['class' => 'form__block-label']) }}
                <div class="form__wrap">
                    @foreach ($roles as $role)
                        {{Form::checkbox('roles[]',  $role->id, $user->roles) }}
                        {{Form::label($role->name, ucfirst($role->name)) }}<br>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="form__block-item col-3">
            {{ Form::submit('Update', ['class' => 'btn btn-info']) }}
            <a href="{{ route('users.index') }}"><span class='btn btn-default'>Cancel</span></a>
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('js-sources')
    <script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/moment.min.js') }}"></script>
@endsection