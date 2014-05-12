<?php

namespace jobs\script\configuration;

use
	jobs,
	jobs\world\configurable,
	jobs\world\configuration
;

class directives implements configuration\directives
{
	private $directives = null;

	public function __construct()
	{
		$this->directives = new jobs\collection;
	}

	public function addDirective(configuration\directive $directive)
	{
		$this->directives->add($directive);

		return $this;
	}

	public function containsDirective(configuration\directive $directive)
	{
		return $this->directives->contains($directive);
	}

	public function execute(configurable $configurable)
	{
		$this->directives
			->walk(function($directive) use ($configurable) {
					$directive->execute($configurable);
				}
			)
		;

		return $this;
	}
}
