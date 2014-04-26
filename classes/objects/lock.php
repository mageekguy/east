<?php

namespace jobs\objects;

use
	jobs\world
;

class lock implements world\objects\lockable
{
	private $key = null;

	public function __construct(world\objects\key $key)
	{
		$this->key = $key;
	}

	public function agentLock(world\objects\key\agent $agent, callable $callable)
	{
		$agent->insertKeyIn($this, function($key) use ($agent, $callable) {
				$key->ifEqualTo($this->key, function() use ($agent, $key, $callable) {
						$callable();

						$agent->takeKey($this, $key);
					}
				);
			}
		);

		return $this;
	}

	public function agentUnlock(world\objects\key\agent $agent, callable $callable)
	{
		$agent->insertKeyIn($this, function($key) use ($agent, $callable) {
				$key->ifEqualTo($this->key, function() use ($agent, $key, $callable) {
						$callable();

						$agent->takeKey($this, $key);
					}
				);
			}
		);

		return $this;
	}
}
