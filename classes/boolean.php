<?php

namespace jobs;

use
	jobs\world
;

class boolean implements world\boolean
{
	private $value = null;

	function __construct($value)
	{
		if ($value instanceof world\boolean)
		{
			$value
				->ifFalse(function() use (& $value) {
					$value = false;
				}
			);
		}

		$this->value = ($value == true);
	}

	function ifTrue(callable $callable)
	{
		return $this->ifIs(true, $callable);
	}

	function ifFalse(callable $callable)
	{
		return $this->ifIs(false, $callable);
	}

	function not()
	{
		$this->value = ! $this->value;

		return $this;
	}

	private function ifIs($boolean, $callable, $reference = null)
	{
		if (($reference ?: $this->value) == $boolean)
		{
			$return = $callable();

			if ($return instanceof world\boolean)
			{
				$return
					->ifTrue(function() { $this->value = true; })
					->ifFalse(function() { $this->value = false; })
				;
			}
		}

		return $this;
	}
}
