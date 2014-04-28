<?php

namespace jobs\objects;

use
	jobs\world,
	jobs\boolean
;

class key implements world\objects\key
{
	private $fingerprint = '';

	public function __construct()
	{
		$this->fingerprint = uniqid();
	}

	public function isEqualTo(world\comparable $comparable)
	{
		if ($comparable == $this)
		{
			return new boolean\true();
		}

		return new boolean\false();
	}

	public function isIdenticalTo(world\comparable $comparable)
	{
		if ($comparable === $this)
		{
			return new boolean\true();
		}

		return new boolean\false();
	}
}
