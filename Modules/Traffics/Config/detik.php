<?php 

return [
	'devices' => [
		'all' => 'all',
		'web' => 'web',
		'desktop' => 'desktop',
		'mobile' => 'mobile',
		'android' => 'android',
		'ios' => 'ios'
	],

	'web' => [
		'allweb' => 'all',
		'desktop' => 'desktop',
		'mobile' => 'mobile'
	],

	'channels' => [
		'all' => 'All Detik',
		'wp' => 'Welcome page',
		'news' => 'News',
		'sport' => 'Sport',
		'finance' => 'Finance',
		'inet' => 'INET',
		'oto' => 'Otomotif',
		'hot' => 'Hot',
		'wolipop' => 'Wolipop',
		'health' => 'Health',
		'travel' => 'Travel',
		'food' => 'Food',
		'20detik' => '20Detik',
		'x' => 'XDetik',
		'forum' => 'Forum'
	],

	//Start of Traffics filters
	'all' => [
		'all' => 'ga:pagePath=~\.detik\.com',
		'desktop' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~mobile|tablet' 
	] ,

	'wp' => [
		'all' => 'ga:pagePath=~^(www.detik.com/|m.detik.com/)$',
		'desktop' => 'ga:pagePath=~^(www.detik.com/|m.detik.com/)$;ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(www.detik.com/|m.detik.com/)$;ga:deviceCategory=~mobile|tablet'
	],

	'news' => [
		'all' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news)',
		'desktop' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~mobile|tablet'
	],

	'sport' => [
		'all' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola)',
		'desktop' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~mobile|tablet'
	],

	'finance' => [
		'all' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance)',
		'desktop' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~mobile|tablet'
	],

	'inet' => [
		'all' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet)',
		'desktop' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~mobile|tablet'
	],

	'oto' => [
		'all' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto)',
		'desktop' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~mobile|tablet'
	],

	'hot' => [
		'all' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot)',
		'desktop' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~mobile|tablet'
	],

	'wolipop' => [
		'all' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop)',
		'desktop' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~mobile|tablet'
	],

	'health' => [
		'all' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health)',
		'desktop' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~mobile|tablet'
	],

	'travel' => [
		'all' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel)',
		'desktop' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~mobile|tablet'
	],

	'food' => [
		'all' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food)',
		'desktop' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~mobile|tablet'
	],

	'20detik' => [
		'all' => 'ga:pagePath=~^(20.detik.com|m.detik.com/20detik)',
		'desktop' => 'ga:pagePath=~^(20.detik.com|m.detik.com/20detik);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(20.detik.com|m.detik.com/20detik);ga:deviceCategory=~mobile|tablet'
	],

	'x' => [
		'all' => 'ga:pagePath=~^x.detik.com',
		'desktop' => 'ga:pagePath=~^x.detik.com;ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^x.detik.com;ga:deviceCategory=~mobile|tablet'
	],

	'forum' => [
		'all' => 'ga:pagePath=~^(forum.detik.com|m.detik.com/forum)',
		'desktop' => 'ga:pagePath=~^(forum.detik.com|m.detik.com/forum);ga:deviceCategory=~desktop',
		'mobile' => 'ga:pagePath=~^(forum.detik.com|m.detik.com/forum);ga:deviceCategory=~mobile|tablet'
	],

	'apps_all' => 'ga:screenName=~.*',
	'apps_wp' => 'ga:screenName=~(detikcom_wp|detikcom$);ga:screenname!~^detikcom_wp/.*/.*',
	'apps_news' => 'ga:screenName=~^detikNews',
	'apps_sport' => 'ga:screenName=~^detikSport|Sepakbola',
	'apps_finance' => 'ga:screenName=~^detikFinance',
	'apps_inet' => 'ga:screenName=~^detikInet',
	'apps_oto' => 'ga:screenName=~^detikOto',
	'apps_hot' => 'ga:screenName=~^detikHot',
	'apps_wolipop' => 'ga:screenName=~^Wolipop',
	'apps_health' => 'ga:screenName=~^detikHealth',
	'apps_travel' => 'ga:screenName=~^detikTravel',
	'apps_food' => 'ga:screenName=~^detikFood',
	'apps_x' => 'ga:screenName=~^detikX',
	// End of Traffics filters
	
];