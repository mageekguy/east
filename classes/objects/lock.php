<?php

namespace jobs\objects;

use
	jobs\world
;

class lock implements world\objects\lockable
{
	private $locked = true;
	private $insertedKey = null;
	private $configuredKey = null;

	public function __construct(world\objects\key $key)
	{
		$this->configuredKey = $key;
	}

	public function takeKey(world\objects\key $key)
	{
		if ($this->insertedKey !== null)
		{
			throw new lock\exception('I can accept only one key at a time');
		}

		$this->insertedKey = $key;

		return $this;
	}

	public function giveKey(world\objects\key\aggregator $aggregator)
	{
		if ($this->insertedKey === null)
		{
			throw new lock\exception('I have no key');
		}

		$aggregator->takeKey($this->insertedKey, $this);

		$this->insertedKey = null;

		return $this;
	}

	public function lock(callable $lockFail)
	{
		return $this->checkInsertedKey(true, $lockFail);
	}

	public function unlock(callable $unlockFail)
	{
		return $this->checkInsertedKey(false, $unlockFail);
	}

	private function checkInsertedKey($boolean, callable $callable)
	{
		if ($this->insertedKey === null)
		{
			throw new lock\exception('Key is missing');
		}

		$this->insertedKey->ifEqualTo($this->configuredKey, function() use ($boolean) { $this->locked = $boolean; });

		if ($this->locked !== $boolean)
		{
			$callable();
		}

		return $this;
	}
}
