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

		(new boolean($callableResult instanceof boolean === false))
			->ifTrue(function() use (& $callableResult) {
					$callableResult = $this->default;
				}
			)
		;

		return $callableResult;
	}
}
