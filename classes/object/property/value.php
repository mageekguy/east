<?php

namespace jobs\object\property;

use
	jobs\world\object
;

class value implements object\property\value
{
	public function match(object\property\value $value)
	{
		if ($this != $value)
		{
			throw new value\exception('Value does not match!');
		}

		return $this;
	}
}
