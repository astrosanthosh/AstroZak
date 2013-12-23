<?php

use AstroZak\Sweph;
use AstroZak\DT;;
use AstroZak\Location;

class SwephTest extends PHPUnit_Framework_TestCase
{
	protected $sweph;
	
	public function setUp()
	{
		$this->sweph = new Sweph();
	}
/*	
	public function testJulianDay()
	{
		$dt = new \DateTime("2012-07-08 11:14:15", new \DateTimeZone("Europe/Kiev"));
		$jd = $this->sweph->julianDay($dt);
		$this->assertEquals( 2456116.8432292, round($jd,7));
	}
	
	public function testDateTime()
	{
		$jday = 2456116.8432292;
		$dt = $this->sweph->dateTime($jday);
		$this->assertEquals("2012-07-08 08:14:15 +0000", Sweph::dt($dt));
	}
*/
	public function testCalcRise()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new \DateTimeZone("Europe/Kiev"));
		
		$ret = $this->sweph->calcRise(Sweph::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-23 06:43:19 +0200", DT::str($ret));
	}
	
	public function testCalcSet()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new\ DateTimeZone("Europe/Kiev"));
		
		$ret = $this->sweph->calcSet(Sweph::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-23 16:25:03 +0200", DT::str($ret));
	}

	public function testCalcUpperMeridianTransit()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new \DateTimeZone("Europe/Kiev"));
		
		$ret = $this->sweph->calcUpperMeridianTransit(Sweph::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-23 11:34:10 +0200", DT::str($ret));
	}
	
	public function testCalcLowerMeridianTransit()
	{
		$location = new Location(49.98, 36.23, 100);
		$dt = new \DateTime("2013-12-22 23:00:00", new \DateTimeZone("Europe/Kiev"));
		
		$ret = $this->sweph->calcLowerMeridianTransit(Sweph::SUN, $location, $dt);
		$ret->setTimeZone(new \DateTimeZone("Europe/Kiev"));
		$this->assertEquals("2013-12-22 23:33:55 +0200", DT::str($ret));
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