<?php

namespace jobs\collections;

use
	jobs,
	jobs\world
;

class set implements world\collections\set
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

	public function add(world\comparable $comparable)
	{
		return $this->ifContains($comparable, function() {}, function() use ($comparable) { $this->comparables->add($comparable); });
	}

	public function remove(world\comparable $comparable)
	{
		$this->comparables
			->walk(function($innerComparable, $key) use ($comparable) { $innerComparable->ifEqualTo($comparable, function() use ($key) { $this->comparables->remove($key)->stop(); }); })
		;

		return $this;
	}

	public function apply($key, callable $callable)
	{
		$this->comparables->apply($key, $callable);

		return $this;
	}

	public function ifContains(world\comparable $comparable, callable $containsCallable, callable $notContainsCallable = null)
	{
		$this->comparables
			->walk(function($innerComparable, $key) use ($comparable, $containsCallable) {
					$innerComparable->ifEqualTo($comparable, function() use ($innerComparable, $key, $containsCallable) {
							$containsCallable($innerComparable, $key); $this->comparables->stop();
						}
					);
				}
			)
		;

		if ($notContainsCallable !== null)
		{
			$this->comparables->ifNotStopped($notContainsCallable);
		}

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
