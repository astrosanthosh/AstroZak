<?php

use AstroZak\Sweph;
use AstroZak\DateTime;


class DateTimeTest extends PHPUnit_Framework_TestCase
{
	protected $sweph;
	
	public function setUp()
	{
		$this->sweph = new Sweph(SWEPH_PATH);
	}
	
	public function testConstructWithDateString()
	{
		$dt = new DateTime("2012-07-08 11:14:15", new DateTimeZone("Europe/Kiev"));
		$jd = $dt->getJulianDay();
		$this->assertEquals( 2456116.8432292, round($jd,7));
	}
	
	public function testConstructWithJulianDay()
	{
		$dt = new DateTime( 2456116.8432292);
		$dtstr = (string) $dt;
		$this->assertEquals("2012-07-08 08:14:15 +0000", $dtstr);
	}
}