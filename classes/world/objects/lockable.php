<?php

namespace jobs\world\objects;

use
	jobs\world\objects\key
;

interface lockable
{
	public function agentLock(key\agent $agent, key $key);
	public function agentUnlock(key\agent $agent, key $key);
}
