<?php
namespace App\Helpers;

class MonthName {

	public static function monthName(String $month)
	{
		$monthNameData = [
			'',
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July',
			'August',
			'September',
			'October',
			'November',
			'December'
		];
		return $monthNameData[(int) $month];
	}
}