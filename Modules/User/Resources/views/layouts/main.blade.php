<!DOCTYPE html>
<html>
@include('user::layouts.head')
<body class="bg-grey">
	
	@include('user::layouts.menu-cpanel')

	<div class="wrapper">
		@include('user::layouts.content')
	</div>

	@include('user::layouts.footer')
	
	@include('user::layouts.js')

	<script type="text/javascript">
		$(function() {
			$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
			});
			@yield('jqueries')
		});
	</script>
	
</body>
</html>

