<?php

namespace AstroZak;

class SkySector
{
	protected $begin;
	protected $end;
	

	public function __construct($begin, $end)
	{
		$this->begin = $begin;
		$this->end = $end;
	}
	
	public function getBegin()
	{
		return $this->begin;
	}
	
	public function getEnd()
	{
		return $this->end;
	}
	
	/**
	 * Negative return means that position is outside sector
	 * 
	 */
	public function getPositionInSector($globalPosition)
	{
		if ($globalPosition < $this->begin || $globalPosition >= $this->end)
		{
			return -1;
		}
		return $globalPosition - $this->begin;
	}
}