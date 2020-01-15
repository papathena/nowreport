

<div class="sidebar onlymob">
	
	@if (Auth::check())
	<div class="sidebar__profile">
		<div class="sidebar__profile-thumb">
			<img src="{{ asset('images/user1.jpg') }}" alt="">
		</div>
		<div class="sidebar__profile-name">
			{{ Auth::user()->name }}
		</div>
		<div class="sidebar__profile-menu">
			<a href="">
				View Profile
			</a>
			<a href="">
				Change Password
			</a>
			<a href="/logout">
				Logout
			</a>
		</div>
	</div>
	@endif
	
</div>



