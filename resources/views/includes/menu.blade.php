<?php

// if($page=="dashboard") { $dashboard="selected";}
// elseif($page=="sm") { $sm="selected";}
// elseif($page=="user") { $user="selected";}
// elseif($page=="workforce") { $workforce="selected";}
// elseif($page=="setting") { $setting="selected";}

// $page = '';	
// $dashboard = '';
// $daily_traffic = '';
// $traffic_overview = '';
// $top_article = '';
// $ta_overview = '';
// $ta_channel_source = '';
// $ta_social_network = '';
// $ta_inbound_marketing = '';
// $video_click = '';
// $channel_source = '';
// $social_network = '';
// $inbound_marketing = '';

/*
if($page=="dashboard") { 
	$dashboard="active";
}
elseif($page=="traffic_overview") { 
	$daily_traffic="open";
	$traffic_overview="active";
}
elseif($page=="week_to_week") { 
	$daily_traffic="open";
	$week_to_week="active";
}
elseif($page=="ta_overview") { 
	$daily_traffic="open";
	$top_article="active";
	$ta_overview="active";
}
elseif($page=="ta_channel_source") { 
	$daily_traffic="open";
	$top_article="active";
	$ta_channel_source="active";
}
elseif($page=="ta_social_network") {
	$daily_traffic="open";
	$top_article="active";
	$ta_social_network="active";
}
elseif($page=="ta_inbound_marketing") {
	$daily_traffic="open";
	$top_article="active";
	$ta_inbound_marketing="active";
}
elseif($page=="video_click") {
	$daily_traffic="open";
	$video_click="active";
}
elseif($page=="channel_source") {
	$daily_traffic="open";
	$channel_source_par="active";
	$channel_source="active";
}
elseif($page=="channel_source_kanal") {
	$daily_traffic="open";
	$channel_source_par="active";
	$channel_source_kanal="active";
}
elseif($page=="social_network") {
	$daily_traffic="open";
	$social_network_par="active";
	$social_network="active";
}
elseif($page=="social_network_kanal") {
	$daily_traffic="open";
	$social_network_par="active";
	$social_network_kanal="active";
}
elseif($page=="inbound_marketing") {
	$daily_traffic="open";
	$inbound_marketing_par="active";
	$inbound_marketing="active";
}
elseif($page=="inbound_marketing_kanal") {
	$daily_traffic="open";
	$inbound_marketing_par="active";
	$inbound_marketing_kanal="active";
}
//MONTHLY
elseif($page=="mth_traffic_overview_mon") { 
	$monthly_traffic="open";
	$mth_traffic_overview="active";
	$mth_traffic_overview_mon="active";
}

elseif($page=="mth_traffic_overview_avd") { 
	$monthly_traffic="open";
	$mth_traffic_overview="active";
	$mth_traffic_overview_avd="active";
}
elseif($page=="mth_ta_overview") { 
	$monthly_traffic="open";
	$mth_top_article="active";
	$mth_ta_overview="active";
}
elseif($page=="mth_ta_channel_source") { 
	$monthly_traffic="open";
	$mth_top_article="active";
	$mth_ta_channel_source="active";
}
elseif($page=="mth_ta_social_network") {
	$monthly_traffic="open";
	$mth_top_article="active";
	$mth_ta_social_network="active";
}
elseif($page=="mth_ta_inbound_marketing") {
	$monthly_traffic="open";
	$mth_top_article="active";
	$mth_ta_inbound_marketing="active";
}
elseif($page=="mth_video_click") {
	$monthly_traffic="open";
	$mth_video_click="active";
}
elseif($page=="mth_channel_source") {
	$monthly_traffic="open";
	$mth_channel_source_par="active";
	$mth_channel_source="active";
}
elseif($page=="mth_channel_source_kanal") {
	$monthly_traffic="open";
	$mth_channel_source_par="active";
	$mth_channel_source_kanal="active";
}
elseif($page=="mth_social_network") {
	$monthly_traffic="open";
	$mth_social_network_par="active";
	$mth_social_network="active";
}
elseif($page=="mth_social_network_kanal") {
	$monthly_traffic="open";
	$mth_social_network_par="active";
	$mth_social_network_kanal="active";
}
elseif($page=="mth_inbound_marketing") {
	$monthly_traffic="open";
	$mth_inbound_marketing_par="active";
	$mth_inbound_marketing="active";
}
elseif($page=="mth_inbound_marketing_kanal") {
	$monthly_traffic="open";
	$mth_inbound_marketing_par="active";
	$mth_inbound_marketing_kanal="active";
}

elseif($page=="achievment_on_target") {
	$monthly_traffic="open";
	$achievment_on_target="active";
}

*/
?>


<div class="sidebar">
	<div class="sidebar__head">
		<a href="index.php" class="sidebar__logo">
			Now
			<br>
			Report
		</a>
		<div class="sidebar__chanel">
			<a href="">
				<img src="images/icon_ga.png" alt="">
				<span>Google Analytic</span>
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
			<a href="dashboard-ga.php" class="menu__link <?php //echo $dashboard ?>">
				Dashboard
			</a>
		</div>
		<div class="menu__item">
			<a class="menu__link dropdown <?php //echo $daily_traffic ?> dishover" data-act="js-drop">
				Daily Traffic
			</a>
			<ul class="menu__drop <?php //echo $daily_traffic ?>" data-act="js-show">
				<li class="menu__drop-item">
					<a href="daily-traffic-all.php" class=" <?php //echo $traffic_overview ?>">
						Traffic Overview
					</a>
				</li>
				<li class="menu__drop-item">
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
				</li>
			</ul>
		</div>

		<div class="menu__item">
			<a class="menu__link dropdown <?php //echo $monthly_traffic ?> dishover" data-act="js-drop">
				Monthly Traffic
			</a>
			<ul class="menu__drop <?php //echo $monthly_traffic ?>" data-act="js-show">
				<li class="menu__drop-item">
					<a class=" <?php //echo $mth_traffic_overview ?> dishover">
						Traffic Overview
					</a>
					
					<ul class="menu__drop">
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_traffic_overview_mon ?>" href="monthly-traffic-all.php">
								Monthly
							</a>
						</li>
						<li class="menu__drop-item">
							<a class="<?php //echo $mth_traffic_overview_avd ?>" href="monthly-traffic-all-average-daily.php">
								Average Daly
							</a>
						</li>
						
					</ul>

				</li>
				<li class="menu__drop-item <?php //echo $mth_top_article ?>">
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
				</li>
			</ul>
		</div>
		
	</div>
</div>



