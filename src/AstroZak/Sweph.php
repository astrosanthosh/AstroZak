<?php

namespace AstroZak;

class Sweph
{
	const SUN = SE_SUN;
	const MOON = SE_MOON;
	const MERCURY = SE_MERCURY;
	const VENUS = SE_VENUS;
	const MARS = SE_MARS;
	const JUPITER = SE_JUPITER;
	const SATURN = SE_SATURN;
	
	private static $planets = array (  self::SUN => "SUN", self::MOON => "MOON",   
									self::MERCURY => "MERCURY", self::VENUS => "VENUS",
									self::MARS => "MARS", self::JUPITER => "JUPITER",
									self::SATURN => "SATURN");
									
	public static function init($path)
	{
		swe_set_ephe_path($path);
	}

	public static function calcRise($planet, Location $location, \DateTime $dt)
	{
		return self::calcRiseTrans($planet, $location, $dt, SE_CALC_RISE);
	}
	
	public static function calcSet($planet, Location $location, \DateTime $dt)
	{
		return self::calcRiseTrans($planet, $location, $dt, SE_CALC_SET);
	}
	
	public static function calcUpperMeridianTransit($planet, Location $location, \DateTime $dt)
	{
		return self::calcRiseTrans($planet, $location, $dt, SE_CALC_MTRANSIT);
	}
	
	public static function calcLowerMeridianTransit($planet, Location $location, \DateTime $dt)
	{
		return self::calcRiseTrans($planet, $location, $dt, SE_CALC_ITRANSIT);
	}
	
	protected static function calcRiseTrans($planet, Location $location, \DateTime $dt, $rsmi)
	{
		$ret = null;
		
		if (! is_numeric($planet) && is_string($planet)) 
		{
			$planet = 0;
			$starname = $planet;
		}
		else
		{
			$starname = '';
		}
		
		$res = swe_rise_trans(DT::julianDay($dt), $planet, $starname, SEFLG_SWIEPH, $rsmi, 
				$location->getLat(), $location->getLon(), $location->getHeight(), 1013.25, 10);
				
		if (isset($res["retflag"]) &&  $res["retflag"] == 0)
		{
			if (! empty($res["tret"][0]))
			{
				$ret = DT::dateTime($res["tret"][0]);
			}
		}
		if (is_null($ret))
		{
			throw new \Exception("swe_rise_trans() failed");
		}
		return $ret;
	}
}