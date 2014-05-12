<?php

namespace jobs\collections;

use
	jobs
;

class stack
{
	private $last = -1;
	private $values = null;

	function __construct()
	{
		$this->values = new jobs\collection;
	}

	function push($value)
	{
		$this->values->add($value);
		$this->last++;

		return $this;
	}

	function pop()
	{
		$this
			->apply(function() { $this->values->remove($this->last); })
				->ifTrue(function() {
						$this->last--;
					}
				)
		;

		return $this;
	}

	function apply(callable $callable)
	{
		return $this->values->apply($this->last, $callable);
	}

	function walk(callable $callable)
	{
		$last = $this->last;
		$break = false;

		while ($break === false && $last >= 0)
		{
			$this
				->values
					->apply($last--, $callable)
						->ifFalse(function() use (& $break) {
								$break = false;
							}
						)
			;
		}

		return new jobs\boolean(! $break);
	}

	function reverse()
	{
		$stack = new self();

		return $this->walk(function($value) use ($stack) { $stack->push($value); });
	}

	function contains($value)
	{
		return $this->values->contains($value);
	}
}
