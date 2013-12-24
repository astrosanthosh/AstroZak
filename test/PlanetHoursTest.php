<?php

use AstroZak\Sweph;
use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\PlanetHours;

class PlanetHoursTest extends PHPUnit_Framework_TestCase
{
	public function testCalcDay()
	{
		$location = new Location(49.98, 36.23, 100);
		//$dt = new \DateTime("2013-12-22 11:00:00", new \DateTimeZone("Europe/Kiev"));
		$dt = new \DateTime("now", new \DateTimeZone("Europe/Kiev"));
		$ret = PlanetHours::calcDay($location, $dt);
		print_r($ret);
		foreach ($ret as $h => $data)
		{
			printf("%2d %20s %10s\n", $h, $data['period'], $data['planet']);
		}
	}
}