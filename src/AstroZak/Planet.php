<?php

namespace AstroZak;

use AstroZak\Sweph;
use AstroZak\SkyObject;;


class Planet extends SkyObject
{
	const SUN = SE_SUN;   //0
	const MOON = SE_MOON;
	const MERCURY = SE_MERCURY;
	const VENUS = SE_VENUS;
	const MARS = SE_MARS;
	const JUPITER = SE_JUPITER;
	const SATURN = SE_SATURN; // 7
	
	private static $names = array   (  self::SUN => "SUN", 
									   self::MOON => "MOON",   
									   self::MERCURY => "MERCURY", 
									   self::VENUS => "VENUS",
									   self::MARS => "MARS", 
									   self::JUPITER => "JUPITER",
									   self::SATURN => "SATURN");

	protected $id;
	  
	public function __construct($planet, $position = 0.0, $speed = 0.0)
	{
		if (is_numeric($planet))
		{
			$id = (int) $planet;
			$this->id = $id;
			$name = $this->getNameById($id);
			
		}
		elseif(is_string($planet))
		{
			$name = $planet;
			$id = $this->getIdByName($name);
			$this->id = $id;
		}
		else
		{
			throw new \Exeption("Wrong planet $planet");
		}
		parent::__construct($name, $position, $speed);
	}

	public function getId()
	{
		return $this->id;
	}

	public function isReversive()
	{
		return ($this->speed < 0) ? true : false;
	}
	
	protected function getNameById($id)
	{
		if (($id < 0) || ($id >= count(self::$names)))
		{
			throw new \Exeption("Wrong planet id: $id");
		}
		return self::$names[$id];
	}

	protected function getIdByName($name)
	{
		$id = array_search ($name, self::$names);
		if (false == $id)
		{
			throw new \Exeption("Wrong planet name: $name");
		}
		return $id;
	}
}