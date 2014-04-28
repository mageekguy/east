<?php

namespace jobs;

use
	jobs\world
;

class boolean implements world\boolean
{
	private $value = null;

	public function __construct($value)
	{
		$this->value = null;
	}

	public function ifTrue(callable $callable)
	{
		if ($this->value == true && $callable() !== null)
		{
			return new self($return);
		}

		return $this;
	}

	public function ifFalse(callable $callable)
	{
		if ($this->value == false && $callable() !== null)
		{
			return new self($return);
		}

		return $this;
	}
}
