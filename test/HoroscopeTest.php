<?php

use AstroZak\Sweph;
use AstroZak\DateTime;
use AstroZak\Location;
use AstroZak\Zodiak;
use AstroZak\Horoscope;

class HoroscopeTest extends PHPUnit_Framework_TestCase
{
	public function testInit()
	{

		$location = new Location(49.93, 36.15, 0);
		$date = new \DateTime("2008-07-25 23:07:00", new \DateTimeZone("Europe/Kiev"));
		$hs = new Horoscope($location, $date);
		$planets = $hs->getPlanets();
		echo "\n";
		foreach($planets as $planet) 
		{
			list($sign, $signPosition) = Zodiak::getSignPosition($planet->getPosition());
			$signName = Zodiak::getSignName($sign);
			list($d, $m, $s) = Sweph::fromDecimal($signPosition);
			printf("%10s %3d %2d' %2d\" %15s\n", $planet->getName(), $d, $m, $s, $signName);  
		}
	}
}