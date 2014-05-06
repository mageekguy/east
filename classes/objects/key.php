<?php

namespace jobs\objects;

use
	jobs\world,
	jobs\boolean
;

class key implements world\objects\key
{
	private $fingerprint = '';

	function __construct()
	{
		$this->fingerprint = uniqid();
	}

	function isEqualTo(world\comparable $comparable)
	{
		return new boolean($comparable == $this);
	}

	function isIdenticalTo(world\comparable $comparable)
	{
		return new boolean($comparable === $this);
	}

	function enterInArea(world\area $area)
	{
		$area->objectEnter($this);

		return $this;
	}

	function leaveArea(world\area $area)
	{
		$area->objectLeave($this);

		return $this;
	}
}
