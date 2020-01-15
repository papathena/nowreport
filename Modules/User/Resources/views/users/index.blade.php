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
			User administration
			<div class="title__float"> |&nbsp;
				<a href="{{ url('user/roles') }}">
						<span>Roles</span>
				</a>
			</div>
			<div class="title__float">
				<a href="{{ url('user/permissions') }}">
						<span>Permissions</span>
				</a> &nbsp;|
			</div>

		</h2>
	</div>

	<div class="section">
		<div class="white-space">
			<div class="section__box">
				<div class="table__box table-fluid">
					<table id="users-list" class="table-default">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
								<tr>
									<td></td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
									@if ($user->id != 1)
									<td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a></td>
									@else
									<td></td>
									@endif
								</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js-sources')
	<script type="text/javascript" src="{{ Module::asset('user:datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/moment.min.js') }}"></script>
@endsection

@section('jqueries')
	var userTbl = $('#users-list').DataTable({
		'searching': true,
		'pageLength' : 10,
		'binfo': true,
		'paging': true,
	});

	userTbl.on( 'order.dt search.dt', function () {
        userTbl.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
@endsection