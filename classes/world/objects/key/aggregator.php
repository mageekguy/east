<?php

namespace jobs\world\objects\key;

use
	jobs\world\objects\key
;

interface aggregator
{
	public function takeKey(key $key);
	public function giveKey(self $aggregator);
}
