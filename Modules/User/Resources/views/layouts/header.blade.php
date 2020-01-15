<!-- HEADER -->
<div class="header">
	<div class="header__bar">

		@if (Auth::check())
		<div class="header__brand" data-act="js-touch">
			
			<div class="header__brand-unit">
				<span class="dropmenu__icon">
					<img src="{{ Module::asset('user:images/icn_dtk.png') }}" alt="">
				</span>
				Detikcom
			</div>
			
			<div class="header__brand-mobile">
				<img src="{{ Module::asset('user:images/icn_dtk.png') }}" alt="">
			</div>
			
			<div class="header__index">
				<a href="index.php" class="">
					Now
					Report
				</a>
			</div>
			<div class="header__brand-section">
				Google Analytic
			</div>

			<div class="dropmenu__brand" data-act="js-show">
				<div class="dropmenu__box">
					<div class="dropmenu__item">
						<a href="" class="dropmenu__brand-link">
							<span class="dropmenu__icon">
								<img src="{{ Module::asset('user:images/icn_dtk.png') }}" alt="">
							</span>
							Detikcom
						</a>
					</div>
					<div class="dropmenu__item">
						<a href="" class="dropmenu__brand-link">
							<span class="dropmenu__icon">
								<img src="{{ Module::asset('user:images/icn_cnn.png') }}" alt="">
							</span>
							CNN Indonesia
						</a>
					</div>
					<div class="dropmenu__item">
						<a href="" class="dropmenu__brand-link">
							<span class="dropmenu__icon">
								<img src="{{ Module::asset('user:images/icn_cnbc.png') }}" alt="">
							</span>
							CNBC Indonesia
						</a>
					</div>
				</div>
			</div>
		</div>
		@endif


		<div class="burger-menu m-menu closed">
			<div class="bar"></div>
			<div class="bar"></div>
			<div class="bar"></div>
		</div>

		@if (Auth::check()) 
		<div class="header__profile" data-act="js-touch">
			
			<div class="header__profile-thumb">
				<!-- <img src="{{ asset('assets/images/user1.jpg') }}" alt=""> -->
			</div>
			<div class="header__profile-name">
				{{ Auth::user()->name }}
			</div>

			<div class="dropmenu" data-act="js-show">
				<div class="dropmenu__box">
					<div class="dropmenu__item">
						<a href="">
							View Profile
						</a>
					</div>
					<div class="dropmenu__item">
						<a href="">
							Change Password
						</a>
					</div>
					<div class="dropmenu__item">
						<a href="{{ route('logout') }}">
							Logout
						</a>
					</div>
				</div>
			</div>
		</div>
		@endif

	</div>
</div>

<!-- E:HEADER -->