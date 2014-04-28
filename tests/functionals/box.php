<?php

namespace jobs\tests\functionals;

require __DIR__ . '/runner.php';

use
	jobs,
	jobs\world,
	jobs\objects\box
;

class object implements world\object
{
	static $objects = 0;

	public function __construct()
	{
		static::$objects++;

		$this->name = static::$objects;
	}

	public function __toString()
	{
		return 'object ' . $this->name;
	}

	public function isEqualTo(world\comparable $object)
	{
		return new jobs\boolean($this == $object);
	}

	public function isIdenticalTo(world\comparable $object)
	{
		return new jobs\boolean($this === $object);
	}
}

class user implements world\objects\box\user
{
	public function takeKey(world\objects\lockable $lockable, world\objects\key $key)
	{
		return $this;
	}

	public function giveKey(world\objects\lockable $lockable, world\objects\key\aggregator $aggregator)
	{
		return $this;
	}

	public function openBox(world\objects\box $box)
	{
		return $box->userOpen($this);
	}

	public function closeBox(world\objects\box $box)
	{
		return $box->userClose($this);
	}

	public function lock(world\objects\lockable $lockable)
	{
		return $this;
	}

	public function unlock(world\objects\lockable $lockable)
	{
		return $this;
	}
}

$user = new user();

(new box())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userRemove($user, 1, function($object) { echo 'Remove ' . $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo 'Remove ' . $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo 'Remove ' . $object . PHP_EOL; })
;
