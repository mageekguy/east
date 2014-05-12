<?php

namespace jobs\script\configuration\cli\parser;

use
	jobs\world\cli,
	jobs\boolean,
	jobs\collections
;

class argument implements cli\parser\argument
{
	private $value = '';

	function __construct($value)
	{
		$this->value = $value;
	}

	function addIn(cli\parser\arguments $arguments)
	{
		$this->addAsOption($arguments)
			->ifFalse(function() use ($arguments) {
					$this->addAsArgument($arguments);
				}
			)
		;

		return $this;
	}

	private function addAsOption(cli\parser\arguments $arguments)
	{
		return $this->isOption()
			->ifTrue(function() use ($arguments) {
					$arguments->addOption($this->value);
				}
			)
		;
	}

	private function addAsArgument(cli\parser\arguments $arguments)
	{
		return $this->isOption()
			->ifFalse(function() use ($arguments) {
					$arguments->addArgument($this->value);
				}
			)
		;
	}

	private function isOption()
	{
		return new boolean(preg_match('/^(\+{1,}|-{1,})[a-z][-_a-z0-9]*/i', $this->value) === 1);
	}
}
