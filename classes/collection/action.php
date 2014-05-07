<?php

namespace jobs\collection;

use
	jobs\boolean
;

class action
{
	private $callable = null;

	public function __construct(callable $callable, boolean $default = null)
	{
		$this->callable = $callable;
		$this->default = $default ?: new boolean\false;
	}

	public function __invoke()
	{
		$callableResult = call_user_func_array($this->callable, func_get_args());

		return (new boolean($callableResult instanceof boolean))
			->ifFalse(function() {
					return $this->default;
				}
			)
			->ifTrue(function() use ($callableResult) {
					return $callableResult;
				}
			)
		;
	}
}
