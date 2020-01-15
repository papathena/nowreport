<!DOCTYPE html>
<html>
@include('toparticles::layouts.head')
<body class="bg-grey">
	
	@include('toparticles::layouts.menu')

	<div class="wrapper">
		@include('toparticles::layouts.content')
	</div>

	@include('toparticles::layouts.footer')
	
	@include('toparticles::layouts.js')

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

