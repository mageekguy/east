<?php

namespace jobs\script;

use
	jobs,
	jobs\world,
	jobs\world\configuration\directive
;

class configuration implements world\configuration
{
	function __construct()
	{
		$this->directives = new configuration\directives;
	}

	function addDirective(directive $directive)
	{
		$this->directives->addDirective($directive);

		return $this;
	}

	function configure(world\configurable $configurable)
	{
		$this->directives->execute($configurable);

		return $this;
	}

	function containsDirective(directive $directive)
	{
		return $this->directives->containsDirective($directive);
	}
}
