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
		'x' => 'XDetik',
	],

	//Start of Top all articles filters
	'toparticles_filter' => [
		'all' => [
			'all' => 'ga:pagePath=~\.detik\.com;ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'news' => [
			'all' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'sport' => [
			'all' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'finance' => [
			'all' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'inet' => [
			'all' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'oto' => [
			'all' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'hot' => [
			'all' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'wolipop' => [
			'all' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'health' => [
			'all' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'travel' => [
			'all' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'food' => [
			'all' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:dimension16=~single|multiple|news',
			'desktop' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple|news',
			'mobile' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple|news'
		],
		'x' => [
			'all' => 'ga:pagePath=~^x.detik.com',
			'desktop' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:deviceCategory=~desktop',
			'mobile' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:deviceCategory=~mobile|tablet'
		],

		'apps_all' => 'ga:screenName=~^.*.*/[0-9]{7}/',
		'apps_news' => 'ga:screenName=~^detikNews.*/[0-9]{7}/',
		'apps_sport' => 'ga:screenName=~^detikSport.*/[0-9]{7}/|Sepakbola.*/[0-9]{7}/',
		'apps_finance' => 'ga:screenName=~^detikFinance.*/[0-9]{7}/',
		'apps_inet' => 'ga:screenName=~^detikInet.*/[0-9]{7}/',
		'apps_oto' => 'ga:screenName=~^detikOto.*/[0-9]{7}/',
		'apps_hot' => 'ga:screenName=~^detikHot.*/[0-9]{7}/',
		'apps_wolipop' => 'ga:screenName=~^Wolipop.*/[0-9]{7}/',
		'apps_health' => 'ga:screenName=~^detikHealth.*/[0-9]{7}/',
		'apps_travel' => 'ga:screenName=~^detikTravel.*/[0-9]{7}/',
		'apps_food' => 'ga:screenName=~^detikFood.*/[0-9]{7}/',
		'apps_x' => 'ga:screenName=~^detikX.*/[0-9]{7}/',

	],
	//End of Top all articles filters

	//Start of Top text articles filters
	'topTextArticles_filter' => [
		'all' => [
			'all' => 'ga:pagePath=~\.detik\.com;ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'news' => [
			'all' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'sport' => [
			'all' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'finance' => [
			'all' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'inet' => [
			'all' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'oto' => [
			'all' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'hot' => [
			'all' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'wolipop' => [
			'all' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'health' => [
			'all' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'travel' => [
			'all' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		'food' => [
			'all' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~mobile|tablet;ga:dimension16=~single|multiple.*news|^news'
		],
		//'x' => [
		//	'all' => 'ga:pagePath=~^x.detik.com',
		//	'desktop' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:deviceCategory=~desktop',
		//	'mobile' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:deviceCategory=~mobile|tablet'
		//],

		//'apps_all' => 'ga:screenName=~^.*.*/[0-9]{7}/',
		//'apps_news' => 'ga:screenName=~^detikNews.*/[0-9]{7}/',
		//'apps_sport' => 'ga:screenName=~^detikSport.*/[0-9]{7}/|Sepakbola.*/[0-9]{7}/',
		//'apps_finance' => 'ga:screenName=~^detikFinance.*/[0-9]{7}/',
		//'apps_inet' => 'ga:screenName=~^detikInet.*/[0-9]{7}/',
		//'apps_oto' => 'ga:screenName=~^detikOto.*/[0-9]{7}/',
		//'apps_hot' => 'ga:screenName=~^detikHot.*/[0-9]{7}/',
		//'apps_wolipop' => 'ga:screenName=~^Wolipop.*/[0-9]{7}/',
		//'apps_health' => 'ga:screenName=~^detikHealth.*/[0-9]{7}/',
		//'apps_travel' => 'ga:screenName=~^detikTravel.*/[0-9]{7}/',
		//'apps_food' => 'ga:screenName=~^detikFood.*/[0-9]{7}/',
		//'apps_x' => 'ga:screenName=~^detikX.*/[0-9]{7}/',

	],
	//End of Top text articles filters

	//Start of Top photo articles filters
	'topPhotoArticles_filter' => [
		'all' => [
			'all' => 'ga:pagePath=~\.detik\.com;ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~\.detik\.com;ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'news' => [
			'all' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'sport' => [
			'all' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'finance' => [
			'all' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'inet' => [
			'all' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'oto' => [
			'all' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'hot' => [
			'all' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'wolipop' => [
			'all' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'health' => [
			'all' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'travel' => [
			'all' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		'food' => [
			'all' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:dimension16=~photo',
			'desktop' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~desktop;ga:dimension16=~photo',
			'mobile' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:deviceCategory=~mobile|tablet;ga:dimension16=~photo'
		],
		//'x' => [
		//	'all' => 'ga:pagePath=~^x.detik.com',
		//	'desktop' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:deviceCategory=~desktop',
		//	'mobile' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:deviceCategory=~mobile|tablet'
		//],

		//'apps_all' => 'ga:screenName=~^.*.*/[0-9]{7}/',
		//'apps_news' => 'ga:screenName=~^detikNews.*/[0-9]{7}/',
		//'apps_sport' => 'ga:screenName=~^detikSport.*/[0-9]{7}/|Sepakbola.*/[0-9]{7}/',
		//'apps_finance' => 'ga:screenName=~^detikFinance.*/[0-9]{7}/',
		//'apps_inet' => 'ga:screenName=~^detikInet.*/[0-9]{7}/',
		//'apps_oto' => 'ga:screenName=~^detikOto.*/[0-9]{7}/',
		//'apps_hot' => 'ga:screenName=~^detikHot.*/[0-9]{7}/',
		//'apps_wolipop' => 'ga:screenName=~^Wolipop.*/[0-9]{7}/',
		//'apps_health' => 'ga:screenName=~^detikHealth.*/[0-9]{7}/',
		//'apps_travel' => 'ga:screenName=~^detikTravel.*/[0-9]{7}/',
		//'apps_food' => 'ga:screenName=~^detikFood.*/[0-9]{7}/',
		//'apps_x' => 'ga:screenName=~^detikX.*/[0-9]{7}/',

	],
	//End of Top photo articles filters

	//Start of Top Push Notofication articles filters
	'topPushArticles_filter' => [
		'all' => [
			//'all' => 'ga:pagePath=~\.detik\.com;ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~\.detik\.com;ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~\.detik\.com;ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'news' => [
			//'all' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(news.detik.com|m.detik.com/news);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'sport' => [
			//'all' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(sport.detik.com|m.detik.com/sport|m.detik.com/sepakbola);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'finance' => [
			//'all' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(finance.detik.com|m.detik.com/finance);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'inet' => [
			//'all' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(inet.detik.com|m.detik.com/inet);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'oto' => [
			//'all' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:deviceCategory=~desktop;ga:dimension16=~single|multiple.*news|^news',
			'mobile' => 'ga:pagePath=~^(oto.detik.com|m.detik.com/oto);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'hot' => [
			//'all' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(hot.detik.com|m.detik.com/hot);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'wolipop' => [
			//'all' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(wolipop.detik.com|m.detik.com/wolipop);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'health' => [
			//'all' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(health.detik.com|m.detik.com/health);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'travel' => [
			//'all' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(travel.detik.com|m.detik.com/travel);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'food' => [
			//'all' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:dimension16=~single|multiple.*news|^news',
			'desktop' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^(food.detik.com|m.detik.com/food);ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],
		'x' => [
			//'all' => 'ga:pagePath=~^x.detik.com',
			'desktop' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:pagetitle!~not set;ga:campaign=~browser;ga:sourcemedium=~notifikasi / desktop',
			'mobile' => 'ga:pagePath=~^x.detik.com.*/[0-9]{8}/.*;ga:pagetitle!~not set;ga:campaign=~browser;ga:sourcemedium=~notifikasi / mobile'
		],

		'apps_all' => 'ga:screenName=~^.*.*/[0-9]{7}/.*/push notification$',
		'apps_news' => 'ga:screenName=~^detikNews.*/[0-9]{7}/.*/push notification$',
		'apps_sport' => 'ga:screenName=~^detikSport.*/[0-9]{7}/.*/push notification$|Sepakbola.*/[0-9]{7}/.*/push notification$',
		'apps_finance' => 'ga:screenName=~^detikFinance.*/[0-9]{7}/.*/push notification$',
		'apps_inet' => 'ga:screenName=~^detikInet.*/[0-9]{7}/.*/push notification$',
		'apps_oto' => 'ga:screenName=~^detikOto.*/[0-9]{7}/.*/push notification$',
		'apps_hot' => 'ga:screenName=~^detikHot.*/[0-9]{7}/.*/push notification$',
		'apps_wolipop' => 'ga:screenName=~^Wolipop.*/[0-9]{7}/.*/push notification$',
		'apps_health' => 'ga:screenName=~^detikHealth.*/[0-9]{7}/.*/push notification$',
		'apps_travel' => 'ga:screenName=~^detikTravel.*/[0-9]{7}/.*/push notification$',
		'apps_food' => 'ga:screenName=~^detikFood.*/[0-9]{7}/.*/push notification$',
		'apps_x' => 'ga:screenName=~^detikX.*/[0-9]{7}/.*/push notification$',

	],
	//End of Top Push Notification articles filters

];