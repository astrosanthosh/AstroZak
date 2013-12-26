<?php

namespace AstroZak;

class Zodiak
{
	const Aries = 0;
	const Taurus = 1;
	const Gemini = 2;
	const Cancer = 3;
	const Leo = 4;
	const Virgo = 5;
	const Libra = 6;
	const Scorpio = 7;
	const Sagittarius = 8;
	const Capricorn = 9;
	const Aquarius = 10;
	const Pisces = 11;

	private static $names = array (Zodiak::Aries => 'Aries',
									Zodiak::Taurus => 'Taurus',
									Zodiak::Gemini => 'Gemini',
									Zodiak::Cancer => 'Cancer',
									Zodiak::Leo => 'Leo',
									Zodiak::Virgo => 'Virgo',
									Zodiak::Libra => 'Libra',
									Zodiak::Scorpio => 'Scorpio',
									Zodiak::Sagittarius => 'Sagittarius',
									Zodiak::Capricorn => 'Capricorn',
									Zodiak::Aquarius => 'Aquarius',
									Zodiak::Pisces => 'Pisces');

										
	
	public static function getSignPosition($position)
	{
		$sign = floor($position / 30.0);
		$positionInSign = $position - $sign * 30.0;
		return array($sign, $positionInSign);
	}

	public static function getSignName($sign)
	{
		if (isset(self::$names[$sign]))
		{
			return self::$names[$sign];
		}
		throw \Exception("Incorrect sign $sign");
	}
	
	public static function getSignShortName($sign)
	{
		return substr($this->getSignName($sign), 0, 3);
	}
}