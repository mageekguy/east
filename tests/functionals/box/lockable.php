<?php

namespace jobs\tests\functionals\box;

require __DIR__ . '/../runner.php';

use
	jobs\world,
	jobs\objects\key,
	jobs\objects\box\lockable
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

	public function ifEqualTo(world\comparable $object, callable $callable)
	{
		if ($this == $object)
		{
			$callable();
		}

		return $this;
	}

	public function ifIdenticalTo(world\comparable $object, callable $callable)
	{
		if ($this === $object)
		{
			$callable();
		}

		return $this;
	}
}

class user implements world\objects\box\user
{
	private $key = null;

	public function takeKey(world\objects\lockable $lockable, world\objects\key $key, callable $callable = null)
	{
		$this->lockable = $lockable;
		$this->key = $key;

		if ($callable !== null)
		{
			$callable();
		}

		return $this;
	}

	public function giveKey(world\objects\lockable $lockable, world\objects\key\aggregator $aggregator, callable $callable = null)
	{
		$lockable->ifEqualTo($this->lockable, function() use ($callable) {
				$aggregator->takeKey($this->key, $callable ?: function() {});

				$this->lockable = null;
				$this->key = null;
			}
		);

		return $this;
	}

	public function openBox(world\objects\box $box, callable $callable = null)
	{
		$box->userOpen($this, $callable);

		return $this;
	}

	public function closeBox(world\objects\box $box, callable $callable = null)
	{
		$box->userClose($this, $callable);

		return $this;
	}

	public function insertKeyIn(world\objects\lockable $lockable, callable $callable)
	{
		$callable($this->key);

		return $this;
	}
}

$user = new user();

$goodKey = new key();
$badKey = new key();

$lockable = (new lockable($goodKey));

$user->takeKey($lockable, $goodKey);

$lockable
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
;

$user->takeKey($lockable, $badKey);

$lockable
	->userRemove($user, 1, function($object) { echo $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo $object . PHP_EOL; })
;

$user->takeKey($lockable, $goodKey);

$lockable
	->userRemove($user, 1, function($object) { echo $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo $object . PHP_EOL; })
;
