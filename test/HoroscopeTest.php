<?php

use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\Planet;
use AstroZak\Sign;
use AstroZak\Horoscope;

class HoroscopeTest extends PHPUnit_Framework_TestCase
{
	public function testInit()
	{
		$location = new Location(49.93, 36.15, 0);
		$date = new \DateTime("2008-07-25 23:07:00", new \DateTimeZone("Europe/Kiev"));
		$hs = new Horoscope($location, $date);
		
		$sun = $hs->getPlanet(Planet::SUN);
		list($sign, $signPosition) = $hs->getPlanetSignPosition($sun);
		$this->assertEquals(Sign::Leo, $sign->getId());
		$this->assertEquals("3.2309", sprintf("%.4f", $signPosition));
		
		$saturn = $hs->getPlanet(Planet::SATURN);
		list($sign, $signPosition) = $hs->getPlanetSignPosition($saturn);
		$this->assertEquals(Sign::Virgo, $sign->getId());
		$this->assertEquals("7.0354", sprintf("%.4f", $signPosition));
	}
}