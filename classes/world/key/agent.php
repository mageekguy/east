<?php

namespace jobs\world\key;

use
	jobs\world\lockable
;

interface agent extends aggregator
{
	public function lock(lockable $lockable);
	public function unlock(lockable $lockable);
}
