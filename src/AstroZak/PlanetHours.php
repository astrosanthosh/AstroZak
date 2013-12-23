<?php

namespace AstroZak;

use AstroZak\DT;
use AstroZak\Location;
use AstroZak\Sweph;


class PlanetHours extends \DateTime
{
	private static $sequence = array( Sweph::SATURN, Sweph::JUPITER, Sweph::MARS, Sweph::SUN, 
									  Sweph::VENUS, Sweph::MERCURY, Sweph::MOON);
	
	private static $daysPlanets = array( DT::Monday => Sweph::MOON,
										 DT::Tuesday => Sweph::MARS,
										 DT::Wednesday => Sweph::MERCURY,
										 DT::Thursday => Sweph::JUPITER,
										 DT::Friday => Sweph::VENUS,
										 DT::Saturday => Sweph::SATURN,
										 DT::Sunday => Sweph::SUN);
	
	protected $sweph;
	protected $timeZone;
	protected $morningRise;
	protected $nextMorningRise;
	protected $set;
	protected $date;
	protected $location;
	
	public function __construct(Location $location, \DateTime $date)
	{
		$this->location = $location;
		$this->date = clone $date;
		$this->sweph = new Sweph();
		
		$date->setTime(12,0); // 12:00
		$this->morningRise = $this->sweph->calcRise(Sweph::SUN, $location, $date);
		$date->setTime(23,0); // 23:00
		$this->set = $this->sweph->calcSet(Sweph::SUN, $location, $date);
		$nextDay = $date->add(new \DateInterval("PT12H")); //11:00 next day
		$this->nextMorningRise = $this->sweph->calcRise(Sweph::SUN, $location, $nextDay);
	}
	
	public function getDayHours()
	{
		$ret = array();
		$dayName = $this->date->format("l");
		$day = DT::getDay($dayName);
		$hourPlanet = self::$daysPlanets[$day];
		
		$lightIn = $this->morningRise->diff($this->set);
		$lightHour = (int) ceil(DT::intervalToSeconds($lightIn) / 12);
		
		$darkIn = $this->set->diff($this->nextMorningRise);
		$darkHour = (int) ceil(DT::intervalToSeconds($darkIn) / 12);
	 
		//echo "Light Hour: " . $lightHour . "\n";
		//echo "Dark Hour: " . $darkHour . "\n";
		
		$lightHour = DT::secondsToInterval($lightHour);
		$darkHour = DT::secondsToInterval($darkHour);
		
		$dt = clone $this->morningRise;
		$dt->setTimeZone($this->date->getTimeZone());
		for($i = 0; $i < 12; $i++)
		{
			echo DT::str($dt) . " : " . Sweph::planetName($hourPlanet) . "\n";
			$hourPlanet = $this->nextPlanet($hourPlanet);
			$dt->add($lightHour);
		}
		
		
		$dt = clone $this->set;
		$dt->setTimeZone($this->date->getTimeZone());
		for($i = 0; $i < 12; $i++)
		{
			echo DT::str($dt) . " : " . Sweph::planetName($hourPlanet) . "\n";
			$hourPlanet = $this->nextPlanet($hourPlanet);
			$dt->add($darkHour);
		}

	}
	
	protected function nextPlanet($planet)
	{
		$pos = array_search($planet, self::$sequence);
		return ($pos < 6) ? self::$sequence[$pos + 1] : self::$sequence[0]; 
	}
	
}