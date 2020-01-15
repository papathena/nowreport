<!DOCTYPE html>
<html>
@include('traffics::layouts.head')
<body class="bg-grey">
	
	@include('traffics::layouts.menu')

	<div class="wrapper">
		@include('traffics::layouts.content')
	</div>

	@include('traffics::layouts.footer')
	
	@include('traffics::layouts.js')

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

