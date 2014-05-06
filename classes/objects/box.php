<?php

namespace jobs\objects;

use
	jobs,
	jobs\boolean,
	jobs\collections,
	jobs\world,
	jobs\world\objects
;

class box implements objects\box
{
	private $objects = null;

	function __construct()
	{
		$this->objects = new jobs\objects();
	}

	function isEqualTo(world\comparable $comparable)
	{
		return new jobs\boolean($this == $comparable);
	}

	function isIdenticalTo(world\comparable $comparable)
	{
		return new jobs\boolean($this === $comparable);
	}

	function userOpen(objects\box\user $user)
	{
		return new boolean\true;
	}

	function userClose(objects\box\user $user)
	{
		return new boolean\true;
	}

	function userAddObject(objects\box\user $user, world\object $object)
	{
		$user
			->openBox($this)
				->ifTrue(function() use ($object) {
						$this->objects->add($object);
					}
				)
		;

		return $this;
	}

	function userRemoveObject(objects\box\user $user)
	{
		$user
			->openBox($this)
				->ifTrue(function() {
						$this->objects->removeLast();
					}
				)
		;

		return $this;
	}

	function userRemoveObjects(objects\box\user $user)
	{
		$user
			->openBox($this)
				->ifTrue(function() {
						$this->objects->removeAll();
					}
				)
		;

		return $this;
	}

	function enterInArea(world\area $area)
	{
		$area->objectEnter($this);

		return $this;
	}
}
