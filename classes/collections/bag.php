<?php

namespace jobs\collections;

use
	jobs,
	jobs\world
;

class bag implements world\collections\bag
{
	private $comparables = null;

	public function __construct()
	{
		$this->comparables = new jobs\collection();
	}

	public function isEmpty()
	{
		return $this->comparables->isEmpty();
	}

	public function isNotEmpty()
	{
		return $this->comparables->isNotEmpty();
	}

	public function hasSize($size)
	{
		return $this->comparables->hasSize($size);
	}

	public function contains(world\comparable $comparable)
	{
		return $this->walk(function($innerComparable) use ($comparable) {
					return $comparable->isIdenticalTo($innerComparable)->not();
				}
			)
				->not()
		;
	}

	public function add(world\comparable $comparable)
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

	public function remove(world\comparable $comparable)
	{
		$this->comparables
			->filter(function($innerComparable) use ($comparable) {
					return $comparable->isIdenticalTo($innerComparable)->not();
				}
			)
		;

		return $this;
	}

	public function removeAt($removedKey)
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

	public function removeLast()
	{
		$this->comparables->removeLast();

		return $this;
	}

	public function removeAll()
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

	public function filter(callable $callable)
	{
		return $this->comparables->filter($callable);
	}

	public function apply($key, callable $callable)
	{
		return $this->comparables->apply($key, $callable);
	}

	public function applyOn(world\comparable $comparable, callable $callable)
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

	public function walk(callable $callable)
	{
		return $this->comparables->walk($callable);
	}
}
