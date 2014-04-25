<?php

namespace jobs;

class object
{
	public function hasProperties(world\object\properties $properties, callable $callable)
	{
		$properties->intersect($this->properties, $callable);

		return $this;
	}
}
