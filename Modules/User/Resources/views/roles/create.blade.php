@extends('user::layouts.main')

@section('headers')
	<!-- <link rel="stylesheet" href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" /> -->
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
			Add Role
		</h2>
	</div>
	<div class="section">
		{{ Form::open(['method' => 'POST', 'route' => ['roles.store']]) }}
		<div class="form__block form__block--half clearfix pt20">
			<div class="form__block-item">
				{{ Form::label('name', 'Role*', ['class' => 'form__block-label']) }}
				<div class="form__wrap">
					{{ Form::text('name', old('name'), ['class' => 'df__input', 'placeholder' => 'type role name', 'required' => '']) }}
				</div>
			</div>
			<div class="form__block-item">
				{{ Form::label('assign', 'Assign Permissions', ['class' => 'form__block-label']) }}
				<div class="form__wrap">
					@foreach ($permissions as $permission)
				        {{Form::checkbox('permissions[]',  $permission->id) }}
				        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>
				    @endforeach
				</div>
			</div>
		</div>
		<div class="form__block-item col-3">
			{{ Form::submit('Add', ['class' => 'btn btn-info']) }}
			<a href="{{ route('roles.index') }}"><span class='btn btn-default'>Cancel</span></a>
		</div>
		{{ Form::close() }}
	</div>
@endsection

@section('js-sources')
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/moment.min.js') }}"></script>
@endsection