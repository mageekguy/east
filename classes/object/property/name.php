<?php

namespace jobs\object\property;

use
	jobs\world\object
;

class name implements object\property\name
{
	public function match(object\property\name $name)
	{
		if ($this != $name)
		{
			throw new name\exception('Name does not match!');
		}

		return $this;
	}
}
