<?php

namespace AstroZak;

use AstroZak\Sweph;

class Planet
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
	  
	public function __construct($planet)
	{
		if (is_numeric($planet))
		{
			$id = (int) $planet;
			if (($id < 0) || ($id >= count(self::$names)))
			{
				throw new \Exeption("Wrong planet id: $id");
			}
			$this->id = $id;
		}
		elseif(is_string($planet))
		{
			$id = array_search ($planet, self::$names);
			if (false == $id)
			{
				throw new \Exeption("Wrong planet name: $planet");
			}
			$this->id = $id;
		}
		else
		{
			throw new \Exeption("Wrong planet $planet");
		}
	}

	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return self::$names[$this->id];
	}
	
	public function __toString()
	{
		return $this->getName();
	}
	
	public function next()
	{
		$id = ($this->id + 1) % count(self::$sequence);
		return new self($id);
	}
}