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
}