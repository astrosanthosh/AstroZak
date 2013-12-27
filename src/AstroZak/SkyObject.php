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

	public function getName()
	{
		return $this->name;
	}

	/**
	 * flat position considering longtitude only
	 */
	public function getPosition()
	{
		return $this->position;
	}
	
	public function getSpeed()
	{
		return $this->speed;
	}
	
	public function isReversive()
	{
		return ($this->speed < 0) ? true : false;
	}
	
	public function __toString()
	{
		return $this->getName();
	}
}