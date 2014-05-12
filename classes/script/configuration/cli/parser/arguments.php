<?php

namespace jobs\script\configuration\cli\parser;

use
	jobs\world\cli,
	jobs\collections
;

class arguments implements cli\parser\arguments
{
	private $arguments = null;

	function __construct()
	{
		$this->arguments = new collections\stack;
	}

	function addOption($value)
	{
		$this->arguments->push(new option($value));

		return $this;
	}

	function addArgument($value)
	{
		$this->arguments
			->apply(function($option) use ($value) {
				$option->addArgument($value);
				}
			)
				->ifFalse(function() {

					}
				)
		;

		return $this;
	}

	function walk(callable $callable)
	{
		return $this->arguments
			->walk(function($argument) use ($callable) {
					return $argument->execute($callable);
				}
			)
		;
	}
}
