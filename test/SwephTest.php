<?php

use AstroZak\Sweph;
use AstroZak\DT;;
use AstroZak\Location;
use AstroZak\Planet;

class SwephTest extends PHPUnit_Framework_TestCase
{
	public function testCalcRise()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new \DateTimeZone("Europe/Kiev"));
		
		$ret = Sweph::calcRise(Planet::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-23 05:48:18 +0200", DT::str($ret));
	}
	
	public function testCalcSet()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new\ DateTimeZone("Europe/Kiev"));
		
		$ret = Sweph::calcSet(Planet::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-23 15:30:02 +0200", DT::str($ret));
	}

	public function testCalcUpperMeridianTransit()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new \DateTimeZone("Europe/Kiev"));
		
		$ret = Sweph::calcUpperMeridianTransit(Planet::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-23 10:39:09 +0200", DT::str($ret));
	}
	
	public function testCalcLowerMeridianTransit()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new \DateTimeZone("Europe/Kiev"));
		
		$ret = Sweph::calcLowerMeridianTransit(Planet::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-23 22:39:24 +0200", DT::str($ret));
	}
	
	public function testGetNameOfDay()
	{
		$ret = DT::getDayName(DT::Wednesday);
		$this->assertEquals("Wednesday", $ret);
	}

	public function testGetDayByName()
	{
		$ret = DT::getDay("Friday");
		$this->assertEquals(DT::Friday, $ret);
	}
}