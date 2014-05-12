<?php

namespace jobs\world\configuration\cli;

use
	jobs\world
;

interface parser
{
	public function parse(array $values, world\configuration $configuration);
}
