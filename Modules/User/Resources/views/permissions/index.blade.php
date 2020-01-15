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
			User Permissions
			<div class="title__float">
				<a href="{{ url('user/permissions/create')}}">
					<span class="icon-add_circle"></span>
					<span>Add permission</span>
				</a>
			</div>
			<div class="title__float"> |&nbsp;
				<a href="{{ url('user/users') }}">
						<span>Users</span>
				</a> 
			</div>
			<div class="title__float"> 
				<a href="{{ url('user/roles') }}">
						<span>Roles</span>
				</a> &nbsp;|
			</div>

		</h2>
	</div>

	<div class="section">
		<div class="white-space">
			<div class="section__box">
				<div class="table__box table-fluid">
					<table id="permission-list" class="table-default">
						<thead>
							<tr>
								<th>No</th>
								<th>Permission</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($permissions as $permission)
								<tr>
									<td></td>
									<td>{{ $permission->name }}</td>
									<td>
										<a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
										{{ Form::open([
                                        	'style' => 'display: inline-block;',
                                        	'method' => 'DELETE',
                                        	'onsubmit' => "return confirm('Are you sure delete this data?');",
                                        	'route' => ['permissions.destroy', $permission->id]
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
	<script type="text/javascript" src="{{ Module::asset('user:datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ Module::asset('user:js/daterange-picker/moment.min.js') }}"></script>
@endsection

@section('jqueries')
	var permsTbl = $('#permission-list').DataTable({
		'searching': true,
		//'order' : [[1, "asc"]],
		'pageLength' : 10,
		'binfo': true,
		'paging': true,
		"columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
	});

	permsTbl.on( 'order.dt search.dt', function () {
        permsTbl.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

@endsection