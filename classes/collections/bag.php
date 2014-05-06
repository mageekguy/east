<?php

namespace jobs\collections;

use
	jobs,
	jobs\world
;

class bag implements world\collections\bag
{
	private $comparables = null;

	function __construct()
	{
		$this->comparables = new jobs\collection();
	}

	function isEmpty()
	{
		return $this->comparables->isEmpty();
	}

	function isNotEmpty()
	{
		return $this->comparables->isNotEmpty();
	}

	function hasSize($size)
	{
		return $this->comparables->hasSize($size);
	}

	function contains(world\comparable $comparable)
	{
		return $this->walk(function($innerComparable) use ($comparable) {
					return $comparable->isIdenticalTo($innerComparable)->not();
				}
			)
				->not()
		;
	}

	function add(world\comparable $comparable)
	{
		$this
			->contains($comparable)
				->ifFalse(function() use ($comparable) {
						$this->comparables->add($comparable);
					}
				)
		;

		return $this;
	}

	function remove(world\comparable $comparable)
	{
		$this->comparables
			->filter(function($innerComparable) use ($comparable) {
					return $comparable->isIdenticalTo($innerComparable)->not();
				}
			)
		;

		return $this;
	}

	function removeAt($removedKey)
	{
		$this
			->comparables
				->filter(function($innerComparable, $key) use ($removedKey) {
						return new jobs\boolean($removedKey != $key);
					}
				)
		;

		return $this;
	}

	function removeLast()
	{
		$this->comparables->removeLast();

		return $this;
	}

	function removeAll()
	{
		$this
			->comparables
				->filter(function() {
						return new jobs\boolean\false;
					}
				)
		;

		return $this;
	}

	function filter(callable $callable)
	{
		return $this->comparables->filter($callable);
	}

	function apply($key, callable $callable)
	{
		return $this->comparables->apply($key, $callable);
	}

	function applyOn(world\comparable $comparable, callable $callable)
	{
		return $this
			->walk(function($innerComparable, $key) use ($comparable, & $innerKey, $callable) {
					return $comparable
						->isIdenticalTo($innerComparable)
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

	function walk(callable $callable)
	{
		return $this->comparables->walk($callable);
	}
}
