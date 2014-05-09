<?php

namespace jobs\world\objects;

use
	jobs\world\objects\key
;

interface lockable
{
	function agentLock(key\agent $agent, key $key);
	function agentUnlock(key\agent $agent, key $key);
}
