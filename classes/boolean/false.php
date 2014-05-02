<?php

namespace jobs\boolean;

use
	jobs
;

class false extends jobs\boolean
{
	public function __construct()
	{
		parent::__construct(false);
	}
}
