<?php

namespace jobs\script\configuration\cli\parser;

use
	jobs\boolean,
	jobs\collection
;

class option
{
	private $name = '';
	private $arguments = [];

	function __construct($name)
	{
		$this->name = $name;
	}

	function addArgument($argument)
	{
		$this->hasArgument($argument)
			->ifFalse(function() use ($argument) {
					$this->arguments[] = $argument;
				}
			)
		;

		return $this;
	}

	function hasArgument($argument)
	{
		return new boolean(in_array($argument, $this->arguments));
	}

	function execute(callable $callable)
	{
		$action = new collection\action($callable, new boolean\true);

		return $action($this->name, $this->arguments);
	}
}
