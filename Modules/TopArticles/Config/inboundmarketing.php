<?php
return [
	'IM_name' => [
		'adwords' => ['title' => 'AdWords', 'filter' => 'ga:sourcemedium=~google / cpc'],
		'facebook cpc' => ['title' => 'Facebook CPC', 'filter' => 'ga:sourcemedium=~facebook / cpc'],
		'facebook oa' => ['title' => 'Facebook OA', 'filter' => 'ga:sourcemedium=~facebook / oa'],
		'facebook organic' => ['title' => 'Facebook Organic', 'filter' => 'ga:source=~facebook.com;ga:medium=~referral'],
		'instagram oa' => ['title' => 'Instagram OA', 'filter' => 'ga:source=~igstories|instagram;ga:medium=~oa'],
		'instagram organic' => ['title' => 'Instagram Organic', 'filter' => 'ga:source=~instagram.com;ga:medium=~referral'],
		'twitter oa' => ['title' => 'Twitter OA', 'filter' => 'ga:source=~^t.co$|twitter|dlvr.it;ga:medium=~referral|btn|twitter'],
		'twitter organic' => ['title' => 'Twitter Organic', 'filter' => 'ga:source=~^t.co$|twitter|dlvr.it;ga:medium=~referral|btn|twitter'],
		'share facebook' => ['title' => 'Share Facebook', 'filter' => 'ga:sourcemedium=~facebook / btn'],
		'share twitter' => ['title' => 'Share Twitter', 'filter' => 'ga:sourcemedium=~twitter / btn'],
		'share whatsapp' => ['title' => 'Share Whatsapp', 'filter' => 'ga:sourcemedium=~whatsapp / btn'],
	],

	'IM_filter' => [
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
		]
	]
];
