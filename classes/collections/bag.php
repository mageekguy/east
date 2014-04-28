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
		$this->init();
	}

	public function count()
	{
		return sizeof($this->comparables);
	}

	public function ifContains(world\comparable $comparable, callable $containsCallable, callable $notContainsCallable = null)
	{
		$this->comparables
			->walk(function($innerComparable, $key) use ($comparable, $containsCallable) {
					$innerComparable
						->isIdenticalTo($comparable)
							->ifTrue(function() use ($innerComparable, $key, $containsCallable) {
									$containsCallable($innerComparable, $key); $this->comparables->stop();
								}
							)
					;
				}
			)
			->ifNotStopped($notContainsCallable ?: function() {});
		;

		return $this;
	}

	public function add(world\comparable $comparable)
	{
		return $this->ifContains($comparable, function() {}, function() use ($comparable) { $this->comparables->add($comparable); });
	}

	public function remove(world\comparable $comparable, callable $callable = null)
	{
		return $this->ifContains($comparable, function($innerComparable, $key) use ($callable) {
				$this->removeAt($key, $callable);
			}
		);
	}

	public function removeAt($removedKey, callable $callable = null)
	{
		if ($callable !== null)
		{
			$this->apply($removedKey, $callable);
		}

		$this->init()->walk(function($comparable, $key) use ($removedKey) {
				if ($key != $removedKey)
				{
					$this->comparables->add($comparable);
				}
			}
		);

		return $this;
	}

	public function removeLast(callable $callable = null, $number = 1)
	{
		$this->comparables->removeLast($callable, $number);

		return $this;
	}

	public function removeAll(callable $callable = null)
	{
		$comparables = $this->init();

		if ($callable !== null)
		{
			$comparables->walk(function($comparable, $key) use ($callable) {
					if ($callable !== null)
					{
						$callable($comparable);
					}
				}
			);
		}

		return $this;
	}

	public function apply($key, callable $callable)
	{
		$this->comparables->apply($key, $callable);

		return $this;
	}

	public function walk(callable $callable)
	{
		$this->comparables->walk($callable);

		return $this;
	}

	public function stop()
	{
		$this->comparables->stop();

		return $this;
	}

	public function ifNotStopped(callable $callable)
	{
		$this->comparables->ifNotStopped($callable);

		return $this;
	}

	private function init()
	{
		$comparables = $this->comparables;

		$this->comparables = new jobs\collection();

		return $comparables;
	}
}
