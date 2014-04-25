<?php

namespace jobs;

use
	jobs\collections,
	jobs\world\object
;

class objects extends collections\bag
{
	public function search(object\properties $properties, callable $callable)
	{
		return $this->walk(function($object) use ($callable, $properties) { $object->hasProperties($properties, $callable); });
	}
}
