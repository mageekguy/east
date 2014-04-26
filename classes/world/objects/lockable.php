<?php

namespace jobs\world\objects;

use
	jobs\world\objects\key
;

interface lockable
{
	public function agentLock(key\agent $agent, callable $callable);
	public function agentUnlock(key\agent $agent, callable $callable);
}
