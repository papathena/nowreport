<?php 
$dashborad = '';
$daily_traffics = '';
$daily_traffics_overview = '';

$daily_toparticles = '';
$daily_toparticles_overview = '';
$daily_toparticles_channelsource = '';
$daily_toparticles_socialnetwork = '';
$daily_toparticles_inboundmarketing = '';

$monthly_traffics = '';
$monthly_traffics_overview = '';
$monthly_traffics_report = '';
$monthly_traffics_avgdaily = '';

$monthly_toparticles = '';
$monthly_toparticles_overview = '';
$monthly_toparticles_channelsource = '';
$monthly_toparticles_socialnetwork = '';
$monthly_toparticles_inboundmarketing = '';

$target_achievement = '';

switch (Request::path()) {
	case 'ga/traffics/daily' :
		$daily_traffics = 'open';
        $daily_traffics_overview = 'active';
		break;
	case 'ga/toparticles/daily' :
		$daily_traffics = 'open';
		$daily_toparticles = 'active';
		$daily_toparticles_overview = 'active';
		break;
	case 'ga/toparticles/csdaily' :
		$daily_traffics = 'open';
		$daily_toparticles = 'active';
		$daily_toparticles_channelsource = 'active';
		break;
	case 'ga/toparticles/sndaily' :
		$daily_traffics = 'open';
		$daily_toparticles = 'active';
		$daily_toparticles_socialnetwork = 'active';
		break;
	case 'ga/toparticles/imdaily' :
		$daily_traffics = 'open';
		$daily_toparticles = 'active';
		$daily_toparticles_inboundmarketing = 'active';
		break;
	case 'ga/traffics/monthly' :
		$monthly_traffics = 'open';
		$monthly_traffics_overview = 'active';
		$monthly_traffics_report = 'active';
		break;
	case 'ga/traffics/avgdaily' :
		$monthly_traffics = 'open';
		$monthly_traffics_overview = 'active';
		$monthly_traffics_avgdaily = 'active';
		break;
	case 'ga/toparticles/monthly' :
		$monthly_traffics = 'open';
		$monthly_toparticles = 'active';
		$monthly_toparticles_overview = 'active';
		break;
	case 'ga/toparticles/csmonthly' :
		$monthly_traffics = 'open';
		$monthly_toparticles = 'active';
		$monthly_toparticles_channelsource = 'active';
		break;
	case 'ga/toparticles/snmonthly' :
		$monthly_traffics = 'open';
		$monthly_toparticles = 'active';
		$monthly_toparticles_socialnetwork = 'active';
		break;
	case 'ga/toparticles/immonthly' :
		$monthly_traffics = 'open';
		$monthly_toparticles = 'active';
		$monthly_toparticles_inboundmarketing = 'active';
		break;
	case 'ga/achievement' :
		$monthly_traffics = 'open';
		$target_achievement = 'active';
		break;
	default:
		$dashboard = 'active';
}

?>

<!-- B: Sidebar -->
<div class="sidebar">
	<!-- B: Sidebar Header -->
	<div class="sidebar__head">
		<a href="{{ route('index') }}" class="sidebar__logo">
			Now
			<br>
			Report
		</a>
		<div class="sidebar__chanel">
			<a href=" {{ route('gaindex') }}">
				<img src="{{ Module::asset('ga:images/icon_ga.png') }}" alt="">
				<span>Google Analytic</span>
			</a>
		</div>
	</div>
	<!-- E: Sidebar Header -->

	<!-- B: Sidebar Menu -->
	<div class="menu">
		<div class="menu__item">
			<a href="{{ route('gaindex')}}" class="menu__link @if (Route::currentRouteName() == 'gaindex') {{ 'active' }} @endif">
				Dashboard
			</a>
		</div>
		<div class="menu__item">
			<a class="menu__link dropdown {{ $daily_traffics }} dishover" data-act="js-drop">
				Daily Traffic
			</a>
			<ul class="menu__drop {{ $daily_traffics }}" data-act="js-show">
				<li class="menu__drop-item">
					<a href="{{ url('ga/traffics/daily') }}" class="{{ $daily_traffics_overview }}">
						Traffic Overview
					</a>
				</li>
				<!-- <li class="menu__drop-item">
					<a href="week-to-week.php" class=" <?php //echo $week_to_week ?>">
						Week to Week
					</a>
				</li> -->
				<li class="menu__drop-item {{ $daily_toparticles }}">
					<a class="{{ $daily_toparticles }} dishover">
						Top Artikel
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="{{ $daily_toparticles_overview }}" href="{{ url('ga/toparticles/daily') }}">
								Overview
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $daily_toparticles_channelsource }}" href="{{ url('ga/toparticles/csdaily') }}">
								Channel Source
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $daily_toparticles_socialnetwork }}" href="{{ url('ga/toparticles/sndaily') }}">
								Social Network
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $daily_toparticles_inboundmarketing }}" href="{{ url('ga/toparticles/imdaily') }}">
								Inbound Marketing
							</a>
						</li> 
					</ul>
				</li>
				<!-- <li class="menu__drop-item">
					<a class="<?php //echo $video_click; ?>" href="daily-video-click.php">
						Video Click
					</a>
				</li>
					</a>
				</li>
				<li class="menu__drop-item">
					<a class="dishover <?php //echo $channel_source_par ?>" >
						Channel Source
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $channel_source; ?>" href="daily-channel-source.php">
								by Channel Source
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $channel_source_kanal; ?>" href="daily-channel-source-kanal.php">
								by Kanal Detikcom
							</a>
						</li>
					</ul>
				</li>
				<li class="menu__drop-item">
					<a class="dishover <?php //echo $social_network_par; ?>">
						Social Network
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $social_network; ?>" href="daily-social-network.php">
								by Social Network
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $social_network_kanal; ?>" href="daily-social-network-kanal.php">
								by Kanal Detikcom
							</a>
						</li>
					</ul>
				</li>
				<li class="menu__drop-item">
					<a class="dishover <?php //echo $inbound_marketing_par; ?>">
						Inbound Marketing
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $inbound_marketing; ?>" href="daily-inbound.php">
								by Source Social
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $inbound_marketing_kanal; ?>" href="daily-inbound-kanal.php">
								by Kanal Detikcom
							</a>
						</li>
					</ul>
				</li> -->
			</ul>
		</div>

		<div class="menu__item">
			<a class="menu__link dropdown {{ $monthly_traffics }} dishover" data-act="js-drop">
				Monthly Traffic
			</a>
			<ul class="menu__drop {{ $monthly_traffics }}" data-act="js-show">
				<li class="menu__drop-item">
					<a class=" {{ $monthly_traffics_overview }} dishover">
						Traffic Overview
					</a>
					
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="{{ $monthly_traffics_report }}" href="{{ url('ga/traffics/monthly') }}">
								Monthly
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $monthly_traffics_avgdaily }}" href="{{ url('ga/traffics/avgdaily') }}">
								Average Daily
							</a>
						</li>
						
					</ul>

				</li>
				<li class="menu__drop-item {{ $monthly_toparticles }}">
					<a class="{{ $monthly_toparticles }} dishover">
						Top Artikel
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="{{ $monthly_toparticles_overview }}" href="{{ url('ga/toparticles/monthly') }}">
								Overview
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $monthly_toparticles_channelsource }}" href="{{ url('ga/toparticles/csmonthly') }}">
								Channel Source
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $monthly_toparticles_socialnetwork }}" href="{{ url('ga/toparticles/snmonthly') }}">
								Social Network
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $monthly_toparticles_inboundmarketing }}" href="{{ url('ga/toparticles/immonthly') }}">
								Inbound Marketing
							</a>
						</li>
					</ul>
				</li>
				<!-- <li class="menu__drop-item">
					<a class="<?php //echo $mth_video_click; ?>" href="monthly-video-click.php">
						Video Click
					</a>
				</li>
					</a>
				</li>
				<li class="menu__drop-item">
					<a class="dishover <?php //echo $mth_channel_source_par; ?>" >
						Channel Source
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_channel_source; ?>" href="monthly-channel-source.php">
								by Channel Source
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_channel_source_kanal; ?>" href="monthly-channel-source-kanal.php">
								by Kanal Detikcom
							</a>
						</li>
					</ul>
				</li>
				<li class="menu__drop-item">
					<a class="dishover <?php //echo $mth_social_network_par; ?>">
						Social Network
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_social_network; ?>" href="monthly-social-network.php">
								by Social Network
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_social_network_kanal; ?>" href="monthly-social-network-kanal.php">
								by Kanal Detikcom
							</a>
						</li>
					</ul>
				</li>
				<li class="menu__drop-item">
					<a class="dishover <?php //echo $mth_inbound_marketing_par; ?>">
						Inbound Marketing
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_inbound_marketing; ?>" href="monthly-inbound.php">
								by Source Social
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_inbound_marketing_kanal; ?>" href="monthly-inbound-kanal.php">
								by Kanal Detikcom
							</a>
						</li>
					</ul>
				</li> -->
				<li class="menu__drop-item">
					<a class="{{ $target_achievement }}" href="{{ url('ga/achievement') }}">
						Achievement
					</a>
				</li>
			</ul>
		</div>
		
	</div>
	<!-- E: Sidebar Menu -->

</div>
<!-- E: Sidebar -->



