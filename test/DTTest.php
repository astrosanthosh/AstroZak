<?php

use AstroZak\Sweph;
use AstroZak\DT;;
use AstroZak\Location;

class DTTest extends PHPUnit_Framework_TestCase
{
	public function testJulianDay()
	{
		$dt = new \DateTime("2012-07-08 11:14:15", new \DateTimeZone("Europe/Kiev"));
		$jd = DT::julianDay($dt);
		$this->assertEquals( 2456116.8432292, round($jd,7));
	}
	
	public function testDateTime()
	{
		$jday = 2456116.8432292;
		$dt = DT::dateTime($jday);
		$this->assertEquals("2012-07-08 08:14:15 +0000", DT::str($dt));
	}
	
	public function testGetDayName()
	{
		$ret = DT::getDayName(DT::Wednesday);
		$this->assertEquals("Wednesday", $ret);
	}

	/**
	 * @expectedException Exception
	 * @excpectedExceptionMessage Incorrect day number: 51
	 */
	public function testGetDayNameWrongParam()
	{
		$ret = DT::getDayName(51);
	}

	public function testGetDay()
	{
		$ret = DT::getDay("Friday");
		$this->assertEquals(DT::Friday, $ret);
	}

	/**
	 * @expectedException Exception
	 * @excpectedExceptionMessage Incorrect day name: WrongDay
	 */
	public function testGetDayWrongParam()
	{
		$ret = DT::getDay("WrongDay");
	}

	public function testIntervalToSeconds()
	{
		$d1 = new \DateTime("2013-12-22 10:00:00", new \DateTimeZone("Europe/Kiev"));
		$d2 = new \DateTime("2013-12-22 11:01:01", new \DateTimeZone("Europe/Kiev")); 
		//positive
		$interval = $d1->diff($d2);
		$ret = DT::intervalToSeconds($interval);
		$this->assertEquals(3661, $ret);
		
		//negative
		$interval = $d2->diff($d1);
		$ret = DT::intervalToSeconds($interval);
		$this->assertEquals(-3661, $ret);
	}
	
	public function testSecondsToInterval()
	{
		// positive
		$in = DT::secondsToInterval(3661); 
		$this->assertEquals(3661, DT::intervalToSeconds($in));

		//negative
		$in = DT::secondsToInterval(-3661); 
		$this->assertEquals(-3661, DT::intervalToSeconds($in));
	}
}