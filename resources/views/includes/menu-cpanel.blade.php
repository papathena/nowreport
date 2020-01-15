<div class="sidebar">

	<div class="sidebar__head">
		<a href="{{ route('index') }}" class="sidebar__logo">
			Now
			<br>
			Report
		</a>
		<div class="sidebar__chanel">
			<a href="">
				<img src="images/icon_setup.png" alt="">
				<span>Control Panel</span>
			</a>
		</div>
	</div>

	<div class="sidebar__profile">
		<div class="sidebar__profile-thumb">
			<img src="images/user1.jpg" alt="">
		</div>
		<div class="sidebar__profile-name">
			Scott Rodriquez
		</div>
		<div class="sidebar__profile-menu">
			<a href="">
				View Profile
			</a>
			<a href="">
				Change Password
			</a>
			<a href="login.php">
				Logout
			</a>
		</div>
	</div>

	<div class="menu">
		
		
		<div class="menu__item">
			<a class="menu__link dishover">
				Configuration
			</a>
			<ul class="menu__drop open">
				<li class="menu__drop-item">
					<a href="{{ route('users.index') }}" class="active">
						Manage user
					</a>
				</li>
				<!-- <li class="menu__drop-item">
					<a href="list-target-traffic.php" class="">
						Target Traffic
					</a>
				</li> -->
			</ul>
		</div>
		
	</div>
</div>



