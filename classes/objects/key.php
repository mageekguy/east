<?php

namespace jobs\objects;

use
	jobs\world
;

class key implements world\objects\key
{
	private $fingerprint = '';

	public function __construct()
	{
		$this->fingerprint = uniqid();
	}

	public function ifEqualTo(world\comparable $comparable, callable $callable)
	{
		if ($comparable == $this)
		{
			$callable();
		}

		return $this;
	}

	public function ifIdenticalTo(world\comparable $comparable, callable $callable)
	{
		if ($comparable === $this)
		{
			$callable();
		}

		return $this;
	}
}
