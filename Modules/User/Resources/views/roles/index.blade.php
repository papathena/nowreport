@extends('user::layouts.main')

@section('headers')
	<!-- <link rel="stylesheet" href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" /> -->
	<link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}" />
	<style>
		.dataTables_wrapper {
			padding: 10px 10px;	
		}
	</style>
@endsection

@section('content')
	<div class="title">
		<h2 class="title__main diline">
			User Roles
			<div class="title__float">
				<a href="{{ url('user/roles/create') }}">
					<span class="icon-add_circle"></span>
					<span>Add role</span>
				</a>
			</div> 
			<div class="title__float"> |&nbsp;
				<a href="{{ url('user/users') }}">
						<span>Users</span>
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
					<table id="roles-list" class="table-default">
						<thead>
							<tr>
								<th>No</th>
								<th>Role</th>
								<th>Permissions</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($roles as $role)
								<tr>
									<td></td>
									<td>{{ $role->name }}</td>
									<!-- <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td> -->
									<td>{{ str_replace(['[',']',',','"'],['','',', ',''],$role->permissions()->pluck('name')) }}</td>
									<td>
										<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
										{{ Form::open([
                                        	'style' => 'display: inline-block;',
                                        	'method' => 'DELETE',
                                        	'onsubmit' => "return confirm('Are you sure delete this data?');",
                                        	'route' => ['roles.destroy', $role->id]
                                         ]) }}
                                         {{ Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) }}
                                         {{ Form::close() }}
									</td>
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
	<script type="text/javascript" src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/moment.min.js') }}"></script>
@endsection

@section('jqueries')
	var roleTbl = $('#roles-list').DataTable({
		'searching': true,
		'pageLength' : 10,
		'binfo': true,
		'paging': true,
	});

	roleTbl.on( 'order.dt search.dt', function () {
        roleTbl.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
@endsection