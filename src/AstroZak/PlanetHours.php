<?php

namespace AstroZak;

use AstroZak\DT;
use AstroZak\Location;
use AstroZak\Sweph;
use AstroZak\Planet;


class PlanetHours extends \DateTime
{
	private static $daysPlanets = array( DT::Monday => Planet::MOON,
										 DT::Tuesday => Planet::MARS,
										 DT::Wednesday => Planet::MERCURY,
										 DT::Thursday => Planet::JUPITER,
										 DT::Friday => Planet::VENUS,
										 DT::Saturday => Planet::SATURN,
										 DT::Sunday => Planet::SUN);
	
	private static $sequence = array( Planet::SATURN, Planet::JUPITER, Planet::MARS, Planet::SUN, 
									  Planet::VENUS, Planet::MERCURY, Planet::MOON);

	public static function calcDay(Location $location, \DateTime $date)
	{
		$dt = clone $date;
		$timeZone = $dt->getTimeZone();
		$dayName = $dt->format("l");
		$day = DT::getDay($dayName);
		$hourPlanet = new Planet(self::$daysPlanets[$day]);

		//rise 
		$dt->setTime(12,0);
		$morningRise = Sweph::calcRise(Planet::SUN, $location, $dt);
		
		//set
		$dt->setTime(23,0);
		$set = Sweph::calcSet(Planet::SUN, $location, $dt);
		
		//next rise
		$nextDay = $dt->add(new \DateInterval("PT12H")); //11:00 next day
		$nextMorningRise = Sweph::calcRise(Planet::SUN, $location, $nextDay);

		$lightInterval = $morningRise->diff($set);
		$darkInterval = $set->diff($nextMorningRise);

		$light = self::calcHalfDay($morningRise, $lightInterval, 0, $hourPlanet, $timeZone);
		$hourPlanet =  self::nextPlanetInSequence($light[11]['planet']);
		$dark = self::calcHalfDay($set, $darkInterval, 12, $hourPlanet, $timeZone);
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
			$hourPlanet = self::nextPlanetInSequence($hourPlanet);
		}
		return $ret;
	}

	protected static function nextPlanetInSequence($planet)
	{
		$pos = array_search($planet->getId(), self::$sequence);
		$pos = ($pos + 1) % count(self::$sequence);
		return new Planet(self::$sequence[$pos]);
	}

}