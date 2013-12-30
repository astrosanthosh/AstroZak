<?php

use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\Planet;
use AstroZak\Sign;
use AstroZak\Horoscope;
use AstroZak\SignPlanets;

class HoroscopeTest extends PHPUnit_Framework_TestCase
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
	public function testGetPlanets()
	{
		$planets = $this->hs->getPlanets();
		$this->assertEquals(7, count($planets));
		$this->assertTrue($planets[5] instanceof Planet);
	}
	
	public function testGetPlanet()
	{
		$planet = $this->hs->getPlanet(Planet::JUPITER);
		$this->assertEquals(5, $planet->getId());
	}
	
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Planet with id = 77 is absent
	 */
	public function testGetPlanetWrongId()
	{
		$planet = $this->hs->getPlanet(77);
	}

}