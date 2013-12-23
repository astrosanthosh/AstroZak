<?php

use AstroZak\Sweph;
use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\PlanetHours;

class PlanetHoursTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
	}
	
	public function testCreate()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 11:00:00", new \DateTimeZone("Europe/Kiev"));
		$ph = new PlanetHours($location, $dt);
		$ret = $ph->getDayHours();

	}
}