<?php

use AstroZak\Planet;


class PlanetTest extends PHPUnit_Framework_TestCase
{
	public function testInitById()
	{
		$planet = new Planet (Planet::VENUS, 22.5, 1.12);
		$this->assertEquals(3, $planet->getId());
		$this->assertEquals("VENUS", $planet->getName());
		//skyObject
		$this->assertEquals(22.5, $planet->getPosition());
		$this->assertEquals(1.12, $planet->getSpeed());
		$this->assertEquals(false, $planet->isReversive());
	}
	
	public function testInitByName()
	{
		$planet = new Planet ("MARS", 111.5, -1.2);
		$this->assertEquals(4, $planet->getId());
		$this->assertEquals("MARS", $planet->getName());
		//skyObject
		$this->assertEquals(111.5, $planet->getPosition());
		$this->assertEquals(-1.2, $planet->getSpeed());
		$this->assertEquals(true, $planet->isReversive());
	}

	
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Wrong planet id: 22
	 */
	public function testInitByWrongId()
	{
		$planet = new Planet(22);
	}
	
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Wrong planet name: BLABLA
	 */
	public function testInitByWrongName()
	{
		$planet = new Planet("BLABLA");
	}
	
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Wrong planet: 1
	 */
	public function testInitByWrongParam()
	{
		$planet = new Planet(true);
	}
}