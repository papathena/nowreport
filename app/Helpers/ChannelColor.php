<?php
namespace App\Helpers;

class ChannelColor {

	public static function channelRgba(String $channel)
	{
		$hexColor = [
			'all' => '2551E1',
			'wp' => '70BDFF',
			'news' => '4D66AE',
			'sport' => 'DD4A54',
			'finance' => '198AC4',
			'inet' => '7559A7',
			'oto' => 'EE3333',
			'hot' => 'D63D33',
			'wolipop' => 'F04195',
			'health' => '33AE72',
			'travel' => 'F58D4C',
			'food' => '97BA5C',
			'20detik' => 'C23535',
			'x' => 'F9A94B',
			'forum' => '38C9FF'
		];
		$color = $hexColor[$channel];
		$red = hexdec(substr($color,0, 2));
		$green = hexdec(substr($color, 2, 2));
		$blue = hexdec(substr($color, 4, 2));
		
		return 'rgba('.$red.', '.$green.', '.$blue.', 1)';
	}
}