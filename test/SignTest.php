<?php

use AstroZak\Sign;


class SignTest extends PHPUnit_Framework_TestCase
{
	public function testInit()
	{
		$sign = new Sign(Sign::Scorpio);
		$this->assertEquals(7, $sign->getId());
		$this->assertEquals("Scorpio", $sign->getName());
		$this->assertEquals("Sco", $sign->getShortName());
		$this->assertEquals(Sign::Water, $sign->getElement());
		$this->assertEquals(Sign::Fixed, $sign->getType());
		$this->assertEquals(false, $sign->isHot());
		$this->assertEquals(true, $sign->isCold());
		$this->assertEquals(true, $sign->isWet());
		$this->assertEquals(false, $sign->isDry());
		//skySector
		$this->assertEquals(210.0, $sign->getBegin());
		$this->assertEquals(240.0, $sign->getEnd());
		$this->assertEquals(10.0, $sign->getPositionInSector(220.0));
		$this->assertEquals(-1, $sign->getPositionInSector(20.0));
	}
	
	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Sign id (abc) has to be integer
	 */
	public function testWrongInitTypeStr()
	{
		$sign = new Sign('abc');
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Sign id (2.7) has to be integer
	 */
	public function testWrongInitTypeFloat()
	{
		$sign = new Sign(2.7);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Sign id (87) is out of range
	 */
	public function testWrongInitRange()
	{
		$sign = new Sign(87);
	}
}