<?php 
$pathDaily = '';
$pathMonthly = '';
(Request::path() == 'ga/traffics/daily') ? $pathDaily = 'open' : $pathDaily = '';

$classDailyActive = '';
(Request::path() == 'ga/traffics/daily') ? $classDailyActive = 'active' : $classDailyActive = '';
if ((Request::path() == 'ga/traffics/monthly') || (Request::path() == 'ga/traffics/avgdaily')) 
	$pathMonthly = 'open';
else
	$pathMonthly = '';

$classMonthlyActive = '';
(Request::path() == 'ga/traffics/monthly') ? $classMonthlyActive = 'active' : $classMonthlyActive = '';
$classAvgDailyActive = '';
(Request::path() == 'ga/traffics/avgdaily') ? $classAvgDailyActive = 'active' : $classAvgDailyActive = '';

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
			<a class="menu__link dropdown {{ $pathDaily }} dishover" data-act="js-drop">
				Daily Traffic
			</a>
			<ul class="menu__drop {{ $pathDaily }}" data-act="js-show">
				<li class="menu__drop-item">
					<a href="{{ url('ga/traffics/daily') }}" class="{{ $classDailyActive }}">
						Traffic Overview
					</a>
				</li>
				<!-- <li class="menu__drop-item">
					<a href="week-to-week.php" class=" <?php //echo $week_to_week ?>">
						Week to Week
					</a>
				</li>
				<li class="menu__drop-item <?php //echo $top_article ?>">
					<a class="<?php //echo $top_article ?> dishover">
						Top Artikel
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $ta_overview; ?>" href="top-article-overview-all-web.php">
								Overview
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $ta_channel_source; ?>" href="top-article-channel-source.php">
								Channel Source
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $ta_social_network; ?>" href="top-article-social.php">
								Social Network
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $ta_inbound_marketing; ?>" href="top-article-inbound.php">
								Inbound Marketing
							</a>
						</li>
					</ul>
				</li>
				<li class="menu__drop-item">
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
			<a class="menu__link dropdown {{ $pathMonthly }} dishover" data-act="js-drop">
				Monthly Traffic
			</a>
			<ul class="menu__drop {{ $pathMonthly }}" data-act="js-show">
				<li class="menu__drop-item">
					<a class=" {{ $classMonthlyActive }} {{ $classAvgDailyActive }} dishover">
						Traffic Overview
					</a>
					
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="{{ $classMonthlyActive }}" href="{{ url('ga/traffics/monthly') }}">
								Monthly
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="{{ $classAvgDailyActive }}" href="{{ url('ga/traffics/avgdaily') }}">
								Average Daily
							</a>
						</li>
						
					</ul>

				</li>
				<!-- <li class="menu__drop-item <?php //echo $mth_top_article ?>">
					<a class="<?php //echo $mth_top_article ?> dishover">
						Top Artikel
					</a>
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_ta_overview; ?>" href="monthly-top-article-overview-all-web.php">
								Overview
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_ta_channel_source; ?>" href="monthly-top-article-channel-source.php">
								Channel Source
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_ta_social_network; ?>" href="monthly-top-article-social.php">
								Social Network
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_ta_inbound_marketing; ?>" href="monthly-top-article-inbound.php">
								Inbound Marketing
							</a>
						</li>
					</ul>
				</li>
				<li class="menu__drop-item">
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
				</li>
				<li class="menu__drop-item">
					<a class="<?php //echo $mth_achievment_on_target; ?>" href="achievment-on-target.php">
						Achievement
					</a>
				</li> -->
			</ul>
		</div>
		
	</div>
	<!-- E: Sidebar Menu -->

</div>
<!-- E: Sidebar -->



