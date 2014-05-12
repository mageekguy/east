<?php

namespace jobs;

use
	jobs\world,
	jobs\world\configuration
;

class script implements world\configurable
{
	function readConfiguration(configuration $configuration)
	{
		$configuration->configure($this);

		return $this;
	}
}
