<?php

namespace jobs;

class area implements world\area
{
	private $objects = null;
	private $doors = null;

	public function __construct()
	{
		$this->objects = new collections\bag();
		$this->doors = new collections\bag();
	}

	public function objectEnter(world\object $object)
	{
		$this->objects->add($object);

		$object->enterInArea($this);

		return $this;
	}

	public function objectLeave(world\object $object)
	{
		$this->objects->remove($object);

		return $this;
	}

	public function addDoor(world\objects\door $door)
	{
		$this
			->objectEnter($door)
			->doors->add($door)
		;

		return $this;
	}
}
