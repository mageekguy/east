<?php

namespace jobs\object;

use
	jobs\world\object,
	jobs\world\object\property\name,
	jobs\world\object\property\value
;

class property implements object\property
{
	private $name = null;
	private $value = null;

	public function __construct(name $name, value $value)
	{
		$this->name = $name;
		$this->value = $value;
	}
}
