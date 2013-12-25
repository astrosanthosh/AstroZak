<?php

namespace AstroZak;

use AstroZak\Sweph;
use AstroZak\SkyObject;;


class Planet extends SkyObject
{
	private static $names = array   (  Sweph::SUN => "SUN", 
									   Sweph::MOON => "MOON",   
									   Sweph::MERCURY => "MERCURY", 
									   Sweph::VENUS => "VENUS",
									   Sweph::MARS => "MARS", 
									   Sweph::JUPITER => "JUPITER",
									   Sweph::SATURN => "SATURN");

	private static $sequence = array( Sweph::SATURN, Sweph::JUPITER, Sweph::MARS, Sweph::SUN, 
									  Sweph::VENUS, Sweph::MERCURY, Sweph::MOON);

	protected $id;
	  
	public function __construct($planet, array $position = array())
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
		parent::__construct($name, $position);
	}

	public function getId()
	{
		return $this->id;
	}

	public function next()
	{
		$pos = array_search($this->id, self::$sequence);
		$pos = ($pos + 1) % count(self::$sequence);
		return new self(self::$sequence[$pos]);
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