<?php

namespace jobs\world\objects\key;

use
	jobs\world\objects\lockable
;

interface agent extends aggregator
{
	public function lock(lockable $lockable, callable $callable);
	public function unlock(lockable $lockable, callable $callable);
}
