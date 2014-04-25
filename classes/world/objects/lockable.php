<?php

namespace jobs\world\objects;

use
	jobs\world\objects\key
;

interface lockable extends key\aggregator
{
	public function takeKey(key $key);
	public function giveKey(key\aggregator $aggregator);
	public function lock(callable $lockFail);
	public function unlock(callable $unlockFail);
}
