<?php

namespace jobs\tests\functionals\box;

require __DIR__ . '/../runner.php';

use
	jobs,
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

	public function openBox(world\objects\box $box)
	{
		return $box->userOpen($this)
			->ifTrue(function() { echo 'Box open!' . PHP_EOL; })
			->ifFalse(function() { echo 'Unable to open box!' . PHP_EOL; })
		;
	}

	public function closeBox(world\objects\box $box)
	{
		return $box->userClose($this);
	}

	public function lock(world\objects\lockable $lockable)
	{
		return $lockable->agentLock($this, $this->key);
	}

	public function unlock(world\objects\lockable $lockable)
	{
		return $lockable->agentLock($this, $this->key);
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
	->userRemove($user, 1, function($object) { echo 'Remove ' . $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo 'Remove ' . $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo 'Remove ' . $object . PHP_EOL; })
;

$user->takeKey($lockable, $goodKey);

$lockable
	->userRemove($user, 1, function($object) { echo 'Remove ' . $object . PHP_EOL; })
	->userRemove($user, 2, function($object) { echo 'Remove ' . $object . PHP_EOL; })
	->userRemoveAll($user, function($object) { echo 'Remove ' . $object . PHP_EOL; })
;
