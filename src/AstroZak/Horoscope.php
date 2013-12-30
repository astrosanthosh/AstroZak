<?php

namespace AstroZak;

use AstroZak\DT;
use AstroZak\Location;
use AstroZak\Sweph;
use AstroZak\Planet;


class Horoscope
{
	protected $location;
	protected $date;
	protected $julianDay;
	protected $planets = array();
	
	public function __construct(Location $location, \DateTime $date)
	{
		$this->location = clone $location;
		$this->date = clone $date;
		$this->julianDay = DT::julianDay($date); 
		for ($planet = 0; $planet < 7; $planet++)
		{
			list($position, $speed) = Sweph::calcBody($this->julianDay, $planet);
			$this->planets[$planet] = new Planet($planet, $position, $speed);
		}
	}
	
	public function getPlanets()
	{
		return $this->planets;
	}
	
	public function getPlanet($planetId)
	{
		if (isset($this->planets[$planetId]))
		{
			return $this->planets[$planetId];
		}
		throw new \Exception ("Planet with id = $planetId is absent");
	}
	/*
	public function getPlanetSign($planet)
	{
		$planet = $this->verifyPlanet($planet);
		$signId = (int) (floor($planet->getPosition() / 30.0));
		return new Sign($signId);
	}
	
	public function getPlanetSignPosition($planet)
	{
		$planet = $this->verifyPlanet($planet);
		$sign = $this->getPlanetSign($planet);
		$position = $sign->getPositionInSector($planet->getPosition());
		return array($sign, $position);
	}
	
	public function getPlanetEssentialStrength($planet)
	{
		
	}
	
	protected function verifyPlanet($planet)
	{
		if (is_numeric($planet))
		{
			$planet = $this->getPlanet($planet);
		}
		elseif (! ($planet instanceof Planet))
		{
			throw new \Exception("Inclorrect planet: $planet");
		}
		return $planet;
	}
	*/
}