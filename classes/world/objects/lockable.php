<?php

namespace jobs\world\objects;

use
	jobs\world\objects\key
;

interface lockable extends key\aggregator
{
	public function ifKeyMatch(callable $callable);
}
