<?php

namespace jobs\objects;

use
	jobs\collections,
	jobs\world,
	jobs\world\objects
;

class box implements objects\box
{
	protected $objects = null;

	public function __construct()
	{
		$this->objects = new collections\bag();
	}

	public function userOpen(objects\box\user $user, callable $callable)
	{
		$callable();

		return $this;
	}

	public function userClose(objects\box\user $user, callable $callable)
	{
		$callable();

		return $this;
	}

	public function userAdd(objects\box\user $user, world\object $object)
	{
		$user->openBox($this, function() use ($object) {
				$this->objects->add($object);
			}
		);

		return $this;
	}

	public function userRemove(objects\box\user $user, $number, callable $callable = null)
	{
		$user->openBox($this, function() use ($number, $callable) {
				$this->objects->removeLast($callable, $number);
			}
		);

		return $this;
	}

	public function userRemoveAll(objects\box\user $user, callable $callable = null)
	{
		$user->openBox($this, function() use ($callable) {
				$this->objects->removeAll($callable);
			}
		);

		return $this;
	}
}
