<?php

use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\Planet;
use AstroZak\Sign;
use AstroZak\Horoscope;
use AstroZak\SignPlanets;

class SignPlanetsTest extends PHPUnit_Framework_TestCase
{
	protected $location;
	protected $date;
	protected $hs;
	
	public function setUp()
	{
		$this->location = new Location(49.93, 36.15, 0);
		$this->date = new \DateTime("2008-07-25 23:07:00", new \DateTimeZone("Europe/Kiev"));
		$this->hs = new Horoscope($this->location, $this->date);
	}

	public function testGetPlanetSign()
	{
		$sun = $this->hs->getPlanet(Planet::SUN);
		$sign = SignPlanets::getPlanetSign($sun);
		$this->assertEquals(Sign::Leo, $sign->getId());
	}
	
	public function testGetPlanetPosition()
	{
		$saturn = $this->hs->getPlanet(Planet::SATURN);
		list($sign, $signPosition) = SignPlanets::getPlanetSignPosition($saturn);
		$this->assertEquals(Sign::Virgo, $sign->getId());
		$this->assertEquals("7.0354", sprintf("%.4f", $signPosition));
	}
	
	public function testGetPlanetEssentialStrength()
	{
		$sun = $this->hs->getPlanet(Planet::SUN);
		$ret = SignPlanets::getPlanetEssentialStrength($sun, false);
		$this->assertEquals(array(1,0,0,0,0,0,0), $ret);
		$jupiter = $this->hs->getPlanet(Planet::JUPITER);
		$ret = SignPlanets::getPlanetEssentialStrength($jupiter, false);
		$this->assertEquals(array(0,0,0,1,0,0,1), $ret);
	}
}