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

	public function ifTrue(callable $callable)
	{
		return $this->ifIs(true, $callable);
	}

	public function ifFalse(callable $callable)
	{
		return $this->ifIs(false, $callable);
	}

	public function not()
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
