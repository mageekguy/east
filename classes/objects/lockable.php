<?php

namespace jobs\objects;

use
	jobs\world
;

class lockable implements world\objects\lockable
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
			throw new lockable\exception('I can accept only one key at a time');
		}

		$this->insertedKey = $key;

		return $this;
	}

	public function giveKey(world\objects\key\aggregator $aggregator)
	{
		if ($this->insertedKey === null)
		{
			throw new lockable\exception('I have no key');
		}

		$aggregator->takeKey($this->insertedKey);

		$this->insertedKey = null;

		return $this;
	}

	public function lock()
	{
		return $this->setLocked(true);
	}

	public function open()
	{
		if ($this->locked === true)
		{
			throw new lockable\exception('Locked!');
		}

		return $this;
	}

	public function unlock()
	{
		return $this->setLocked(false);
	}

	public function close()
	{
		return $this;
	}

	private function setLocked($boolean)
	{
		if ($this->insertedKey === null)
		{
			throw new lockable\exception('Key is missing');
		}

		try
		{
			$this->insertedKey->match($this->configuredKey);
		}
		catch (\exception $exception)
		{
			throw new lockable\exception('Key does not match');
		}

		$this->locked = $boolean;

		return $this;
	}
}
