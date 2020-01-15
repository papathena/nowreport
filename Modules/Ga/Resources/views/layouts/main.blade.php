<!DOCTYPE html>
<html>
@include('ga::layouts.head')
<body class="bg-grey">
	@include('ga::layouts.menu')
	<div class="wrapper">
		@include('ga::layouts.content')
	</div>
	@include('ga::layouts.footer')
</body>
@include('ga::layouts.js')
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
</html>

