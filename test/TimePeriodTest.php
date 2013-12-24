<?php

use AstroZak\Sweph;
use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\TimePeriod;

class TimePeriodTest extends PHPUnit_Framework_TestCase
{
	protected $d1;
	protected $d2;
	protected $d3;
	protected $d4;
	protected $dtutc;
	
	
	public function setUp()
	{
		$tz = new \DateTimeZone("Europe/Kiev");
		$this->dt1 = new \DateTime("2013-12-22 11:00:00", $tz);
		$this->dt2 = new \DateTime("2013-12-22 14:00:00", $tz);
		$this->dt3 = new \DateTime("2013-12-22 12:00:00", $tz);
		$this->dt4 = new \DateTime("2013-12-20 12:00:00", $tz);
		$this->dtutc = new \DateTime("2013-12-25 14:00:00", new \DateTimeZone("UTC"));
	}
	
	public function testInside()
	{

		$tp = new TimePeriod($this->dt1, $this->dt2);
		
		$ret =$tp->inside($this->dt3);
		$this->assertTrue($ret);
		
		$ret =$tp->inside($this->dt4);
		$this->assertFalse($ret);
	}
	
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage TimePeriod must be positive
	 */
	public function testNegative()
	{
		$tp = new TimePeriod($this->dt2, $this->dt1);
	}
	
	public function testStringConversion()
	{
		$tp = new TimePeriod($this->dt1, $this->dt2);
		$ret = (string) $tp;
		$this->assertEquals("11:00:00 - 14:00:00 +0200", $ret);
		
		
		$tp = new TimePeriod($this->dt1, $this->dtutc);
		$ret = (string) $tp;
		$this->assertEquals("2013-12-22 11:00:00 - 2013-12-25 16:00:00 +0200", $ret);

	}
}