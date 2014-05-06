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

	function __construct(objects\key $key)
	{
		parent::__construct();

		$this->lock = new lock($key);
	}

	function userOpen(objects\box\user $user)
	{
		return $user->unlock($this);
	}

	function userClose(objects\box\user $user)
	{
		return $user->lock($this);
	}

	function agentLock(world\objects\key\agent $agent, world\objects\key $key)
	{
		return $this->lock->agentLock($agent, $key);
	}

	function agentUnlock(world\objects\key\agent $agent, world\objects\key $key)
	{
		return $this->lock->agentLock($agent, $key);
	}
}
