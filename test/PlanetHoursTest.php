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
		$dt = new \DateTime("2013-12-22 11:00:00", new \DateTimeZone("Europe/Kiev"));
		$ret = PlanetHours::calcDay($location, $dt);
		$hour = 1;
		$data = $ret[$hour];
		$checkstr = sprintf("%2d %20s %10s", $hour, $data['period'], $data['planet']);
		$this->assertEquals(" 1 06:36:47 - 07:25:16 +0200      VENUS", $checkstr);
		$hour = 14;
		$data = $ret[$hour];
		$checkstr = sprintf("%2d %20s %10s", $hour, $data['period'], $data['planet']);
		$this->assertEquals("14 17:53:10 - 19:04:44 +0200        SUN", $checkstr);
	}
}