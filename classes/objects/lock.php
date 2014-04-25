<?php

namespace jobs\objects;

use
	jobs\world
;

class lock implements world\objects\lockable
{
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

	public function ifKeyMatch(callable $callable)
	{
		if ($this->insertedKey !== null)
		{
			$this->insertedKey->ifEqualTo($this->configuredKey, function() use ($callable) { $callable(); });
		}

		return $this;
	}
}
