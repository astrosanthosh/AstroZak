<?php

use AstroZak\Sweph;
use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\Horoscope;

class HoroscopeTest extends PHPUnit_Framework_TestCase
{
	public function testInit()
	{
		$location = new Location(49.98, 36.23, 0);
		$date = new \DateTime("2013-12-22 11:00:00", new \DateTimeZone("Europe/Kiev"));
		$hs = new Horoscope($location, $date);
		print_r($hs);
	}
}