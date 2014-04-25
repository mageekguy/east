<?php

namespace jobs\objects;

use
	jobs\world,
	jobs\collections
;

class box
{
	private $objects = null;

	public function __construct()
	{
		$this->objects = new collections\bag();
	}

	public function add(world\object $object)
	{
		$this->objects->add($object);

		return $this;
	}

	public function remove($number, callable $callable = null)
	{
		$this->objects->removeLast($callable, $number);

		return $this;
	}

	public function removeAll(callable $callable = null)
	{
		$this->objects->removeAll($callable);

		return $this;
	}
}
