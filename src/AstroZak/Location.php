<?php

namespace AstroZak;

class Location
{
	protected $lat;
	protected $lon;
	protected $height;
	
	public function __construct($lat, $lon, $height = 0)
	{
		//TODO Check values type and range
		$this->lat = $lat;
		$this->lon = $lon;
		$this->height = $height;
	}

	public function getLat()
	{
		return $this->lat;
	}

	public function getLon()
	{
		return $this->lon;
	}
	
	
	public function getHeight()
	{
		return $this->height;
	}
}
	