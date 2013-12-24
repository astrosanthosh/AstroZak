<?php

namespace Astrozak;

class TimePeriod
{
	
	protected $start;
	protected $end;

	public function __construct(\DateTime $start, \DateTime $end)
	{
		if ($start > $end)
		{
			throw new \Exception("TimePeriod must be positive");
		}
		$this->start = clone $start;
		$this->end = clone $end;
		$timeZoneStart = $this->start->getTimeZone();
		$timeZoneEnd = $this->end->getTimeZone();
		if ($timeZoneStart->getName() != $timeZoneEnd->getName())
		{
			$this->end->setTimeZone($timeZoneStart);
		}
	}
	
	public function inside(\DateTime $dt)
	{
		$ret = false;
		if ($this->start <= $dt && $dt <= $this->end)
		{
			$ret = true;
		}
		return $ret;
	}
	
	public function __toString()
	{
		$sday = $this->start->format("Y-m-d");
		$eday = $this->end->format("Y-m-d");
		if ($sday == $eday)
		{
			$ret = $this->start->format("H:i:s") . " - " . $this->end->format("H:i:s"); 
		}
		else
		{
			$ret = $this->start->format("Y-m-d H:i:s") . " - " . $this->end->format("Y-m-d H:i:s");
		}
		$ret .= " " . $this->start->format("O");
		return $ret;
	}
}