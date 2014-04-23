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

	public function count()
	{
		return sizeof($this->comparables);
	}

	public function ifContains(world\comparable $comparable, callable $containsCallable, callable $notContainsCallable = null)
	{
		$this->comparables
			->walk(function($innerComparable, $key) use ($comparable, $containsCallable) {
					$innerComparable->ifIdenticalTo($comparable, function() use ($innerComparable, $key, $containsCallable) {
							$containsCallable($innerComparable, $key); $this->comparables->stop();
						}
					);
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

	public function remove(world\comparable $comparable)
	{
		return $this->ifContains($comparable, function($innerComparable, $key) {$this->comparables->remove($key)->stop(); });
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
}
