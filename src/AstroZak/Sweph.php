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
	
	public function __construct($path)
	{
		swe_set_ephe_path($path);
	}

	public function calcRise($planet, Location $location, DateTime $dt)
	{
		return $this->calcRiseTrans($planet, $location, $dt, SE_CALC_RISE);
	}
	
	public function calcSet($planet, Location $location, DateTime $dt)
	{
		return $this->calcRiseTrans($planet, $location, $dt, SE_CALC_SET);
	}
	
	public function calcUpperMeridianTransit($planet, Location $location, DateTime $dt)
	{
		return $this->calcRiseTrans($planet, $location, $dt, SE_CALC_MTRANSIT);
	}
	
	public function calcLowerMeridianTransit($planet, Location $location, DateTime $dt)
	{
		return $this->calcRiseTrans($planet, $location, $dt, SE_CALC_ITRANSIT);
	}
	
	protected function calcRiseTrans($planet, Location $location, DateTime $dt, $rsmi)
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
		
		$res = swe_rise_trans($dt->getJulianDay(), $planet, $starname, SEFLG_SWIEPH, $rsmi, 
				$location->getLat(), $location->getLon(), $location->getHeight(), 1013.25, 10);
				
		if (isset($res["retflag"]) &&  $res["retflag"] == 0)
		{
			if (! empty($res["tret"][0]))
			{
				$ret = new DateTime($res["tret"][0]);
			}
		}
		if (is_null($ret))
		{
			throw new \Exception("swe_rise_trans() failed");
		}
		return $ret;
	}
}