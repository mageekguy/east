<?php

namespace jobs\world\key;

use
	jobs\world\key
;

interface aggregator
{
	public function takeKey(key $key);
	public function giveKey(self $aggregator);
}
