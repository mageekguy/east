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
		if ($comparable == $this)
		{
			return new boolean\true();
		}

		return new boolean\false();
	}

	function isIdenticalTo(world\comparable $comparable)
	{
		if ($comparable === $this)
		{
			return new boolean\true();
		}

		return new boolean\false();
	}

	function enterInArea(world\area $area)
	{
		$area->objectEnter($this);

		return $this;
	}
}
