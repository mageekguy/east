<?php

namespace jobs\boolean;

use
	jobs\world\boolean
;

class true implements boolean
{
	public function ifTrue(callable $callable)
	{
		$return = $callable();

		if ($return !== null && $return == false)
		{
			return new false();
		}

		return $this;
	}

	public function ifFalse(callable $callable)
	{
		return $this;
	}
}
