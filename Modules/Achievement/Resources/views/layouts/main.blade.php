<!DOCTYPE html>
<html>
@include('achievement::layouts.head')
<body class="bg-grey">
	
	@include('achievement::layouts.menu')

	<div class="wrapper">
		@include('achievement::layouts.content')
	</div>

	@include('achievement::layouts.footer')
	
	@include('achievement::layouts.js')

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

