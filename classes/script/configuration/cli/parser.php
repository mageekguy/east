<?php

namespace jobs\script\configuration\cli;

use
	jobs\world
;

class parser
{
	private $callable = null;

	function __construct(callable $callable)
	{
		$this->callable = $callable;
	}

	function parse(array $values)
	{
		$arguments = new parser\arguments;

		foreach ($values as $value)
		{
			(new parser\argument($value))->addIn($arguments);
		}

		$arguments->walk($this->callable);

		return $this;
	}
}
