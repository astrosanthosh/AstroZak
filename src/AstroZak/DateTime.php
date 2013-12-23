<?php

namespace AstroZak;

class DateTime extends \DateTime
{
	protected $julianDay = null;
	
	public function __construct($time = "now", \DateTimeZone $timezone = NULL)
	{
		if (is_string($time))
		{
			parent::__construct($time, $timezone);
			$this->setTimeZone(new \DateTimeZone('UTC'));
		}
		elseif(is_double($time))
		{
			$this-> julianDay = $time;
			$time = $this->julianDayToTimeString($time);
			$timezone = new \DateTimeZone('UTC');
			parent::__construct($time, $timezone);
		}
		else
		{
			throw new \Exception("Wrong data for DateTime constructor!");
		}
	}
	
	public function getJulianDay()
	{
		if (is_null($this->julianDay))
		{
			$dtstr = $this->format("Y m d H i s");
			list($year, $month, $day, $hour, $min, $sec) = sscanf($dtstr, "%d %d %d %d %d %d");
			$hour = $hour + $min / 60 + $sec / 3600;
			$this->julianDay = swe_julday($year, $month, $day, $hour, SE_GREG_CAL);
		}
		return $this->julianDay;
	}
	
	protected function julianDayToTimeString($jd)
	{
		$date = swe_revjul ($jd, SE_GREG_CAL);
		$tsec = (int) ($date['hour'] * 3600);
		$tsecmin = $tsec % 3600;
		$hours = (int)(($tsec - $tsecmin) / 3600);
		$secs = $tsecmin % 60;
		$mins = (int)(($tsecmin - $secs) / 60);
		$str = sprintf("%d-%02d-%02d %02d:%02d:%02d", $date['year'], $date['month'], $date['day'],
						$hours, $mins, $secs);
		return $str;
	}
	
	public function __toString()
	{
		return $this->format("Y-m-d H:i:s O");
	}
}