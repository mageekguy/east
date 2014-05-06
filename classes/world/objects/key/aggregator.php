<?php

namespace jobs\world\objects\key;

use
	jobs\world\objects\key,
	jobs\world\objects\lockable
;

interface aggregator
{
	function takeKey(lockable $lockable, key $key);
	function giveKey(lockable $lockable, self $aggregator);
}
