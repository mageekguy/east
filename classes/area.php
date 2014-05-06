<?php

namespace jobs;

class area implements world\area
{
	private $objects = null;
	private $doors = null;

	function __construct()
	{
		$this->objects = new collections\bag();
		$this->doors = new collections\bag();
	}

	function objectEnter(world\object $object)
	{
		$this
			->objects
				->contains($object)
					->ifFalse(function() use ($object) {
							$this->objects->add($object);

							$object->enterInArea($this);
						}
					)
		;

		return $this;
	}

	function containsObject(world\object $object)
	{
		return $this->objects->contains($object);
	}

	function numberOfObjectsIs($number)
	{
		return $this->objects->hasSize($number);
	}

	function objectLeave(world\object $object)
	{
		$this->objects->remove($object);

		return $this;
	}

	function addDoor(world\objects\door $door)
	{
		$this
			->hasDoor($door)
				->ifFalse(function() use ($door) {
						$this->objectEnter($door);

						$this->doors->add($door);
					}
				)
		;

		return $this;
	}

	function hasDoor(world\objects\door $door)
	{
		return $this->doors->contains($door);
	}

	function numberOfDoorsIs($number)
	{
		return $this->doors->hasSize($number);
	}
}
