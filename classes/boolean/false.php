<?php

namespace jobs\boolean;

use
	jobs\world\boolean
;

class false implements boolean
{
	public function ifTrue(callable $callable)
	{
		return $this;
	}

	public function ifFalse(callable $callable)
	{
		if ($callable() == true)
		{
			return new true();
		}

		return $this;
	}
}
