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

	public function __construct()
	{
		$this->objects = new jobs\objects();
	}

	public function userOpen(objects\box\user $user)
	{
		return new boolean\true();
	}

	public function userClose(objects\box\user $user)
	{
		return new boolean\true();
	}

	public function userAddObject(objects\box\user $user, world\object $object)
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

	public function userRemoveObject(objects\box\user $user)
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

	public function userRemoveObjects(objects\box\user $user)
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
}
