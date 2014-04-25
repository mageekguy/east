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

	public function takeKey(world\objects\key $key)
	{
		$this->key = $key;

		return $this;
	}

	public function giveKey(world\objects\key\aggregator $aggregator)
	{
		$aggregator->takeKey($this->key);

		$this->key = null;

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

	public function lock(world\objects\lockable $lockable, callable $callable)
	{
		$lockable
			->takeKey($this->key)
			->ifKeyMatch(function() use($callable, & $locked) {
					$locked = true; $callable();
				}
			)
			->giveKey($this)
		;

		if ($locked === null)
		{
			echo 'Unable to lock!' . PHP_EOL;
		}

		return $this;
	}

	public function unlock(world\objects\lockable $lockable, callable $callable)
	{
		$lockable
			->takeKey($this->key)
			->ifKeyMatch(function() use ($callable, & $unlocked) {
					$unlocked = true;
					$callable();
				}
			)
			->giveKey($this);

		if ($unlocked === null)
		{
			echo 'Unable to unlock!' . PHP_EOL;
		}

		return $this;
	}
}

$user = new user();

$goodKey = new key();
$badKey = new key();

$user->takeKey($goodKey);

$lockable = (new lockable($goodKey))
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
;

$lockable
	->userRemove($user, 1, function($object) { echo $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo $object . PHP_EOL; })
;

$user->takeKey($badKey);

$lockable = (new lockable($goodKey = new key()))
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
	->userAdd($user, new object())
;

$lockable
	->userRemove($user, 1, function($object) { echo $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo $object . PHP_EOL; })
;
