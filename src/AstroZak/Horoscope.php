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
		swe_set_topo($location->getLat(), $location->getLon(), $location->getHeight());
		for ($planet = 0; $planet < 7; $planet++)
		{
			$position = Sweph::calcUt($this->julianDay, $planet, SEFLG_SPEED | SEFLG_TRUEPOS);
			$this->planets[$planet] = new Planet($planet, $position);
		}
	}
	
}