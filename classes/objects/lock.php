<?php

namespace jobs\objects;

use
	jobs\world
;

class lock implements world\objects\lockable
{
	private $key = null;

	function __construct(world\objects\key $key)
	{
		$this->key = $key;
	}

	function agentLock(world\objects\key\agent $agent, world\objects\key $key)
	{
		return $key
			->isEqualTo($this->key)
				->ifTrue(function() use ($agent, $key) {
						$agent->takeKey($this, $key);
					}
				)
		;
	}

	function agentUnlock(world\objects\key\agent $agent, world\objects\key $key)
	{
		return $key
			->isEqualTo($this->key)
				->ifTrue(function() use ($agent, $key) {
						$agent->takeKey($this, $key);
					}
				)
		;
	}
}
