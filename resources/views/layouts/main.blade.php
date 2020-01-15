<!DOCTYPE html>
<html>
@include('includes.head')
<body>
	<!-- wrapper -->
		@include('includes.menu-home')
	<!-- CONTENT -->		
	<div class="container">		
		@include('includes.header')
		@yield('content')
	</div>
	<!-- E: CONTENT -->
	@include('includes.footer')
</body>
@include('includes.js')
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