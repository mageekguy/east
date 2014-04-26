<?php

namespace jobs\objects\box;

use
	jobs\objects\box,
	jobs\objects\lock,
	jobs\world,
	jobs\world\objects
;

class lockable extends box implements objects\lockable
{
	private $lock = null;

	public function __construct(objects\key $key)
	{
		parent::__construct();

		$this->lock = new lock($key);
	}

	public function userOpen(objects\box\user $user, callable $callable)
	{
		$this->agentUnlock($user, $callable);

		return $this;
	}

	public function userClose(objects\box\user $user, callable $callable)
	{
		$this->agentLock($user, $callable);

		return $this;
	}

	public function agentLock(world\objects\key\agent $agent, callable $callable)
	{
		$this->lock->agentLock($agent, $callable);

		return $this;
	}

	public function agentUnlock(world\objects\key\agent $agent, callable $callable)
	{
		$this->lock->agentLock($agent, $callable);

		return $this;
	}
}
