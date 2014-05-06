<?php

namespace jobs\collections;

use
	jobs\world,
	jobs\collections
;

class set extends collections\bag implements world\collections\set
{
	function contains(world\comparable $comparable)
	{
		return $this->walk(function($innerComparable) use ($comparable) {
					return $comparable->isEqualTo($innerComparable)->not();
				}
			)
				->not()
		;
	}

	function remove(world\comparable $comparable)
	{
		$this
			->filter(function($innerComparable) use ($comparable) {
					return $comparable->isEqualTo($innerComparable)->not();
				}
			)
		;

		return $this;
	}

	function applyOn(world\comparable $comparable, callable $callable)
	{
		return $this
			->walk(function($innerComparable, $key) use ($comparable, & $innerKey, $callable) {
					return $comparable
						->isEqualTo($innerComparable)
							->ifTrue(function() use (& $innerKey, $key) {
									$innerKey = $key;
								}
							)
								->not()
					;
				}
			)
				->not()
					->ifTrue(function() use ($comparable, $innerKey, $callable) {
							return $callable($comparable, $innerKey);
						}
					)
		;
	}
}
