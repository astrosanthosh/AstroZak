<?php

namespace AstroZak;

class SkyObject
{
	private static $params = array('longitude', 'latitude', 'distance', 'speedInLong', 'speedInLat', 'speedInDist');
	protected $name;
	protected $longitude = 0.0; 
	protected $latitude = 0.0; 
	protected $distance = 0.0; 
	protected $speedInLong = 0.0; 
	protected $speedInLat = 0.0;
	protected $speedInDist = 0.0;
	  
	public function __construct($name, array $position)
	{
		$this->name = $name;
		$this->setPosition($position);
	}

	public function setPosition(array $position)
	{
		foreach (self::$params as $param)
		{
			if (! empty($position[$param]) && is_numeric($position[$param]))
			{
				$this->$param = $position[$param];
			}
		}
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