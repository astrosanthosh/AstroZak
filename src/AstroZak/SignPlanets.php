<?php

namespace AstroZak;
use AstroZak\Planet;
use AstroZak\Sign;
use AstroZak\SkySector;

class SignPlanets
{
	const Home = 0;
	const Exaltation = 1;
	const Triciplet = 2;
	const Term = 3;
	const Fas = 4;
	const Exile = 5;
	const Fall = 6;
	
	private static $data = array(
		
		Sign::Aries => array(
			self::Home => Planet::MARS,
			self::Exaltation => Planet::SUN,
			self::Triciplet => array(Planet::SUN, Planet::JUPITER),
			self::Term => array(6 => Planet::JUPITER, 14 => Planet::VENUS, 21 => Planet::MERCURY,
								26 => Planet::MARS, 30 => Planet::SATURN),
			self::Fas => array( 10 => Planet::MARS, 20 => Planet::SUN, 30 => Planet::VENUS),
			self::Exile => Planet::VENUS,
			self::Fall =>  Planet::SATURN,
		),
		
		Sign::Taurus => array(
			self::Home => Planet::VENUS,
			self::Exaltation => Planet::MOON,
			self::Triciplet => array(Planet::MARS, Planet::MOON),
			self::Term => array(8 => Planet::VENUS, 15 => Planet::MERCURY, 22 => Planet::JUPITER,
								26 => Planet::SATURN, 30 => Planet::MARS),
			self::Fas => array( 10 => Planet::MERCURY, 20 => Planet::MOON, 30 => Planet::SATURN),
			self::Exile => Planet::MARS,
			self::Fall =>  -1,
		),
		
		Sign::Gemini => array(
			self::Home => Planet::MERCURY,
			self::Exaltation => -1,
			self::Triciplet => array(Planet::SATURN, Planet::MERCURY),
			self::Term => array(7 => Planet::MERCURY, 14 => Planet::JUPITER, 21 => Planet::VENUS,
								25 => Planet::SATURN, 30 => Planet::MARS),
			self::Fas => array( 10 => Planet::JUPITER, 20 => Planet::MARS, 30 => Planet::SUN),
			self::Exile => Planet::JUPITER,
			self::Fall =>  -1,
		),

		Sign::Cancer => array(
			self::Home => Planet::MOON,
			self::Exaltation => Planet::JUPITER,
			self::Triciplet => array(Planet::MARS, Planet::MARS),
			self::Term => array(6 => Planet::MARS, 13 => Planet::JUPITER, 20 => Planet::MERCURY,
								27 => Planet::VENUS, 30 => Planet::SATURN),
			self::Fas => array( 10 => Planet::VENUS, 20 => Planet::MERCURY, 30 => Planet::MOON),
			self::Exile => Planet::SATURN,
			self::Fall =>  Planet::MARS,
		),

		Sign::Leo => array(
			self::Home => Planet::SUN,
			self::Exaltation => -1,
			self::Triciplet => array(Planet::SUN, Planet::JUPITER),
			self::Term => array(6 => Planet::SATURN, 13 => Planet::MERCURY, 19 => Planet::VENUS,
								25 => Planet::JUPITER, 30 => Planet::MARS),
			self::Fas => array( 10 => Planet::SATURN, 20 => Planet::JUPITER, 30 => Planet::MARS),
			self::Exile => Planet::SATURN,
			self::Fall =>  -1,
		),

		Sign::Virgo => array(
			self::Home => Planet::MERCURY,
			self::Exaltation => Planet::MERCURY,
			self::Triciplet => array(Planet::VENUS, Planet::MOON),
			self::Term => array(6 => Planet::MERCURY, 13 => Planet::VENUS, 18 => Planet::JUPITER,
								24 => Planet::SATURN, 30 => Planet::MARS),
			self::Fas => array( 10 => Planet::SUN, 20 => Planet::VENUS, 30 => Planet::MERCURY),
			self::Exile => Planet::JUPITER,
			self::Fall =>  Planet::VENUS,
		),

		Sign::Libra => array(
			self::Home => Planet::VENUS,
			self::Exaltation => Planet::SATURN,
			self::Triciplet => array(Planet::SATURN, Planet::MERCURY),
			self::Term => array(6 => Planet::SATURN, 11 => Planet::VENUS, 19 => Planet::JUPITER,
								24 => Planet::MERCURY, 30 => Planet::MARS),
			self::Fas => array( 10 => Planet::MOON, 20 => Planet::SATURN, 30 => Planet::JUPITER),
			self::Exile => Planet::MARS,
			self::Fall =>  Planet::SUN,
		),

		Sign::Scorpio => array(
			self::Home => Planet::MARS,
			self::Exaltation => -1,
			self::Triciplet => array(Planet::MARS, Planet::MARS),
			self::Term => array(6 => Planet::MARS, 14 => Planet::JUPITER, 21 => Planet::VENUS,
								27 => Planet::MERCURY, 30 => Planet::SATURN),
			self::Fas => array( 10 => Planet::MARS, 20 => Planet::SUN, 30 => Planet::VENUS),
			self::Exile => Planet::VENUS,
			self::Fall =>  Planet::MOON,
		),

		Sign::Sagittarius => array(
			self::Home => Planet::JUPITER,
			self::Exaltation => -1,
			self::Triciplet => array(Planet::SUN, Planet::JUPITER),
			self::Term => array(8 => Planet::JUPITER, 14 => Planet::VENUS, 19 => Planet::MERCURY,
								25 => Planet::SATURN, 30 => Planet::MARS),
			self::Fas => array( 10 => Planet::MERCURY, 20 => Planet::MOON, 30 => Planet::SATURN),
			self::Exile => Planet::MERCURY,
			self::Fall =>  -1,
		),

		Sign::Capricorn => array(
			self::Home => Planet::SATURN,
			self::Exaltation => Planet::MARS,
			self::Triciplet => array(Planet::VENUS, Planet::MOON),
			self::Term => array(6 => Planet::VENUS, 12 => Planet::MERCURY, 19 => Planet::JUPITER,
								25 => Planet::MARS, 30 => Planet::SATURN),
			self::Fas => array( 10 => Planet::JUPITER, 20 => Planet::MARS, 30 => Planet::SUN),
			self::Exile => Planet::MOON,
			self::Fall =>  Planet::JUPITER,
		),

		Sign::Aquarius => array(
			self::Home => Planet::SATURN,
			self::Exaltation => -1,
			self::Triciplet => array(Planet::SATURN, Planet::MERCURY),
			self::Term => array(6 => Planet::SATURN, 12 => Planet::MERCURY, 20 => Planet::VENUS,
								25 => Planet::JUPITER, 30 => Planet::MARS),
			self::Fas => array( 10 => Planet::VENUS, 20 => Planet::MERCURY, 30 => Planet::MOON),
			self::Exile => Planet::SUN,
			self::Fall =>  -1,
		),

		Sign::Pisces => array(
			self::Home => Planet::JUPITER,
			self::Exaltation => Planet::VENUS,
			self::Triciplet => array(Planet::MARS, Planet::MARS),
			self::Term => array(8 => Planet::VENUS, 14 => Planet::JUPITER, 20 => Planet::MERCURY,
								26 => Planet::MARS, 30 => Planet::SATURN),
			self::Fas => array( 10 => Planet::SATURN, 20 => Planet::JUPITER, 30 => Planet::MARS),
			self::Exile => Planet::MERCURY,
			self::Fall =>  Planet::MERCURY,
		),
	);
	
	public static function getPlanetSign(Planet $planet)
	{
		$signId = (int) (floor($planet->getPosition() / 30.0));
		return new Sign($signId);
	}
	
	public static function getPlanetSignPosition(Planet $planet)
	{
		$sign = self::getPlanetSign($planet);
		$position = $sign->getPositionInSector($planet->getPosition());
		return array($sign, $position);
	}
	
	public static function getPlanetEssentialStrength(Planet $planet, $sunUnderHorison)
	{
		$ret = array();
		$planetId = $planet->getId();
		
		$sign = self::getPlanetSign($planet);
		$signId = $sign->getId();
		$signBegin = $sign->getBegin();
		$data = self::$data[$signId];
		$ret[self::Home] = ($data[self::Home] == $planetId) ? 1 : 0;
		$ret[self::Exaltation] = ($data[self::Exaltation] == $planetId) ? 1 : 0;
		if ($sunUnderHorison)
		{
			$ret[self::Triciplet] = ($data[self::Triciplet][0] == $planetId) ? 1 : 0;
		}
		else
		{
			$ret[self::Triciplet] = ($data[self::Triciplet][1] == $planetId) ? 1 : 0;
		}
		$ret[self::Term] = self::searchPlanet($planet, $data[self::Term], $signBegin);
		$ret[self::Fas] = self::searchPlanet($planet, $data[self::Fas], $signBegin);
		$ret[self::Exile] = ($data[self::Exile] == $planetId) ? 1 : 0;
		$ret[self::Fall] = ($data[self::Fall] == $planetId) ? 1 : 0;
		return $ret;
	}
	
	protected static function searchPlanet($planet, $map, $signBegin)
	{
		$ret = 0;
		$planetId = $planet->getId();
		$planetPos = $planet->getPosition();
		$begin = $signBegin;
		foreach ($map as $pos => $id)
		{
			$end = $signBegin + $pos;
			$sector = new SkySector($begin, $end);
			if ($sector->getPositionInSector($planetPos) >= 0)
			{
				if ($planetId == $id)
				{
					$ret = 1;
				}
				break;
			}
			$begin = $end;
		}
		return $ret;
	}
	
}
