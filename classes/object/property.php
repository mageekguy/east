<?php

namespace jobs\object;

use
	jobs\world,
	jobs\world\object,
	jobs\world\object\property\name,
	jobs\world\object\property\value
;

class property implements object\property
{
	private $name = null;
	private $value = null;

	function __construct(name $name, value $value)
	{
		$this->name = $name;
		$this->value = $value;
	}

	function linkTo(world\object $object, world\area $area)
	{
		$area->addObject($object, $this->name, $this->value);

		return $this;
	}
}
