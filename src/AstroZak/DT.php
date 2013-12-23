<?php

namespace AstroZak;

class DT
{

	const Monday = 0;
	const Tuesday = 1;
	const Wednesday = 2;
	const Thursday = 3;
	const Friday = 4;
	const Saturday = 5;
	const Sunday = 6;
	
	private static $days = array (  self::Monday => "Monday", self::Tuesday => "Tuesday",   
									self::Wednesday => "Wednesday", self::Thursday => "Thursday",
									self::Friday => "Friday", self::Saturday => "Saturday",
									self::Sunday => "Sunday");
								

	public static function getDayName($day)
	{
		if (isset(self::$days[$day]))
		{
			return self::$days[$day];
		}
		throw new Exception("Incorrect day number");
	}
	
	public static function getDay($dayName)
	{
		$ret = array_search($dayName, self::$days);
		if (false === $ret)
		{
			throw new Exception("Incorrect day name");
		}
		return $ret;
	}
	
	public static function julianDay(\DateTime $date)
	{
		$dt = clone $date;
		$dt->setTimeZone (new \DateTimeZone("UTC")); 
		$dtstr = $dt->format("Y m d H i s");
		list($year, $month, $day, $hour, $min, $sec) = sscanf($dtstr, "%d %d %d %d %d %d");
		$hour = $hour + $min / 60 + $sec / 3600;
		return swe_julday($year, $month, $day, $hour, SE_GREG_CAL);
	}

	public static function dateTime($julianDay)
	{
		$date = swe_revjul ($julianDay, SE_GREG_CAL);
		$tsec = (int) ($date['hour'] * 3600);
		$tsecmin = $tsec % 3600;
		$hours = (int)(($tsec - $tsecmin) / 3600);
		$secs = $tsecmin % 60;
		$mins = (int)(($tsecmin - $secs) / 60);
		$str = sprintf("%d-%02d-%02d %02d:%02d:%02d", $date['year'], $date['month'], $date['day'],
						$hours, $mins, $secs);
		return new \DateTime($str, new \DateTimeZone('UTC'));
	}

	public static function str(\DateTime $date)
	{
		return $date->format("Y-m-d H:i:s O");
	}
	
	public static function intervalToSeconds(\DateInterval $i)
	{
		$ret = ($i->y * 365 * 24 * 60 * 60) + ($i->m * 30 * 24 * 60 * 60) +
				($i->d * 24 * 60 * 60) + ($i->h * 60 * 60) + ($i->i * 60) + $i->s;
		$sign = $i->format("%R");
		if ($sign == "-")
		{
			$ret = -$ret;
		}
		return $ret;
	}
	
	public static function secondsToInterval($sec)
	{
		$ret = new \DateInterval('PT'.abs($sec).'S');
		if ($sec < 0)
		{
			$ret->invert = 1;
		}
		return $ret;
	}
}
