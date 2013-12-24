<?php

namespace AstroZak;

use AstroZak\DT;
use AstroZak\Location;
use AstroZak\Sweph;
use AstroZak\Planet;


class PlanetHours extends \DateTime
{
	private static $daysPlanets = array( DT::Monday => Sweph::MOON,
										 DT::Tuesday => Sweph::MARS,
										 DT::Wednesday => Sweph::MERCURY,
										 DT::Thursday => Sweph::JUPITER,
										 DT::Friday => Sweph::VENUS,
										 DT::Saturday => Sweph::SATURN,
										 DT::Sunday => Sweph::SUN);
	
	public static function calcDay(Location $location, \DateTime $date)
	{
		$dt = clone $date;
		$timeZone = $dt->getTimeZone();
		$dayName = $dt->format("l");
		$day = DT::getDay($dayName);
		$hourPlanet = new Planet(self::$daysPlanets[$day]);

		//rise 
		$dt->setTime(12,0);
		$morningRise = Sweph::calcRise(Sweph::SUN, $location, $dt);
		
		//set
		$dt->setTime(23,0);
		$set = Sweph::calcSet(Sweph::SUN, $location, $dt);
		
		//next rise
		$nextDay = $dt->add(new \DateInterval("PT12H")); //11:00 next day
		$nextMorningRise = Sweph::calcRise(Sweph::SUN, $location, $nextDay);

		$lightInterval = $morningRise->diff($set);
		$darkInterval = $set->diff($nextMorningRise);

		$light = self::calcHalfDay($morningRise, $lightInterval, 0, $hourPlanet, $timeZone);
		$hourPlanet = $light[11]['planet'];
		$dark = self::calcHalfDay($set, $darkInterval, 12, $hourPlanet->next(), $timeZone);
		return array_merge($light, $dark);
	}

	protected static function calcHalfDay($startDateTime, $interval, $index, $hourPlanet, $timeZone)
	{
		$ret = array();
		$hourSeconds = (int) ceil(DT::intervalToSeconds($interval) / 12);
		$hourInterval = DT::secondsToInterval($hourSeconds);
		
		$dt = clone $startDateTime;
		$dt->setTimeZone($timeZone);
		for($i = $index; $i < ($index + 12); $i++)
		{
			$dtstart = clone $dt;
			$dt->add($hourInterval);
			$ret[$i] =  array('period' => new TimePeriod($dtstart, $dt), 'planet' => $hourPlanet);
			$hourPlanet = $hourPlanet->next();
		}
		return $ret;
	}

	

}