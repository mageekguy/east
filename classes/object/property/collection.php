<?php

namespace jobs\object\property;

use
	jobs\world\object,
	jobs\world\object\property\name,
	jobs\world\object\property\value
;

class collection
{
	private $nameStorage = null;

	function add(name $name, value $value, object $object)
	{
		return $this;
	}
}
