<?php

namespace jobs\objects\box;

use
	jobs\objects\box,
	jobs\objects\lock,
	jobs\world,
	jobs\world\objects
;

class lockable extends box
{
	private $lock = null;

	public function __construct(objects\key $key)
	{
		parent::__construct();

		$this->lock = new lock($key);
	}

	public function userOpen(objects\box\user $user, callable $callable)
	{
		$user->unlock($this->lock, $callable);

		return $this;
	}

	public function userClose(objects\box\user $user, callable $callable)
	{
		$user->lock($this->lock, $callable);

		return $this;
	}
}
