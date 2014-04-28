<?php

namespace jobs\world\objects\key;

use
	jobs\world\objects\key,
	jobs\world\objects\lockable
;

interface aggregator
{
	public function takeKey(lockable $lockable, key $key);
	public function giveKey(lockable $lockable, self $aggregator);
}
