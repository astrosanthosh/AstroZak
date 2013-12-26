<?php

namespace AstroZak;

class SkyObject
{
	protected $name;
	protected $position; 
	protected $speed; 
	  
	public function __construct($name, $position, $speed)
	{
		$this->name = $name;
		$this->position = $position;
		$this->speed = $speed;
	}

	/**
	 * flat position considering longtitude only
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	public function aboveHorizon()
	{
		return ($this->position > 180.0) ? true : false; 
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function __toString()
	{
		return $this->getName();
	}
}