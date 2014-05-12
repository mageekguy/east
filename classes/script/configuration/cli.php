<?php

namespace jobs\script\configuration;

use
	jobs\script,
	jobs\world\configuration
;

class cli extends script\configuration
{
	public function __construct(array $values, configuration\cli\parser $parser)
	{
		$parser->parse($values, $this);
	}
}
