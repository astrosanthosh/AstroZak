<?php

namespace AstroZak;

class Sign extends SkySector
{
	//signs
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

	//types
	const Cardinal = 0;
	const Fixed = 1;
	const Mutable = 1;
	
	//basic
	const Hot = 1;
	const Cold = 2;
	const Wet = 4;
	const Dry = 8;
	
	//elements
	const Fire =   9; // Hot | Dry
	const Earth = 10; // Cold | Dry
	const Air =    5; // Hot | Wet
	const Water =  6; // Cold | Wet
	
	private static $names = array (self::Aries => 'Aries',
									self::Taurus => 'Taurus',
									self::Gemini => 'Gemini',
									self::Cancer => 'Cancer',
									self::Leo => 'Leo',
									self::Virgo => 'Virgo',
									self::Libra => 'Libra',
									self::Scorpio => 'Scorpio',
									self::Sagittarius => 'Sagittarius',
									self::Capricorn => 'Capricorn',
									self::Aquarius => 'Aquarius',
									self::Pisces => 'Pisces');

	private static $elements = array (self::Aries => self::Fire,
										self::Taurus => self::Earth,
										self::Gemini => self::Air,
										self::Cancer => self::Water,
										self::Leo => self::Fire,
										self::Virgo => self::Earth,
										self::Libra => self::Air,
										self::Scorpio => self::Water,
										self::Sagittarius => self::Fire,
										self::Capricorn => self::Earth,
										self::Aquarius => self::Air,
										self::Pisces => self::Water);

	private static $types = array (self::Aries => self::Cardinal,
									self::Taurus => self::Fixed,
									self::Gemini => self::Mutable,
									self::Cancer => self::Cardinal,
									self::Leo => self::Fixed,
									self::Virgo => self::Mutable,
									self::Libra => self::Cardinal,
									self::Scorpio => self::Fixed,
									self::Sagittarius => self::Mutable,
									self::Capricorn => self::Cardinal,
									self::Aquarius => self::Fixed,
									self::Pisces => self::Mutable);

	protected $id;
	
	public function __construct($id)
	{
		if ( (! is_numeric($id)) || strval(intval($id)) != strval($id))
		{
			throw new \Exception("Sign id ($id) has to be integer");
		}
		if ($id < self::Aries || $id > self::Pisces)
		{
			throw new \Exception("Sign id ($id) is out of range");
		}
		$this->id = $id;
		parent::__construct($id * 30.0, ($id + 1) * 30.0);
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return self::$names[$this->id];
	}
	
	public function getShortName()
	{
		return substr(self::$names[$this->id], 0, 3);
	}

	public function getElement()
	{
		return self::$elements[$this->id];
	}

	public function getType()
	{
		return self::$types[$this->id];
	}
	
	public function isHot()
	{
		return (($this->getElement() & self::Hot) > 0);
	}

	public function isCold()
	{
		return (($this->getElement() & self::Cold) > 0);
	}
	
	public function isDry()
	{
		return (($this->getElement() & self::Dry) > 0) ;
	}

	public function isWet()
	{
		return (($this->getElement() & self::Wet) > 0);
	}

}