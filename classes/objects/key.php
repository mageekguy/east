<?php

namespace jobs\objects;

use
	jobs\world,
	jobs\object,
	jobs\object\property
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

	public function addIn(world\area $area)
	{
		(new object\property(new property\name('color'), new property\value('silver')))->linkTo($this, $area);

		return $this;
	}
}
