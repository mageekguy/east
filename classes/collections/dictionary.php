<?php

namespace jobs\collections;

use
	jobs\collection as valuesCollection,
	jobs\collections\set as objectsCollection,
	jobs\world\comparable,
	jobs\world\collections
;

class dictionary implements collections\dictionary
{
	private $objects = null;
	private $values = null;

	public function __construct()
	{
		$this->objects = new objectsCollection();
		$this->values = new valuesCollection();
	}

	public function count()
	{
		return count($this->objects);
	}

	public function add(comparable $object, $value)
	{
		$this->objects->ifContains(
			$object,
			function($innerObject, $key) use ($value) {
				$this->values->add($value, $key);
			},
			function() use ($object, $value) {
				$this->objects->add($object);
				$this->values->add($value);
			}
		);

		return $this;
	}

	public function remove(comparable $object)
	{
		$this->objects->ifContains(
			$object,
			function($innerObject, $key) {
				$this->objects->remove($innerObject);
				$this->values->remove($key);
			}
		);

		return $this;
	}

	public function apply(comparable $comparable, callable $callable)
	{
		return $this->ifContains($comparable, $callable);
	}

	public function ifContains(comparable $comparable, callable $containsCallable, callable $notContainsCallable = null)
	{
		$this->objects->ifContains($comparable, function($comparable, $key) use ($containsCallable) { $this->values->apply($key, $containsCallable); }, $notContainsCallable);

		return $this;
	}

	public function walk(callable $callable)
	{
		$this->values->walk(function($value, $key) use ($callable) { $this->objects->apply($key, function($object) use ($value, $callable) { call_user_func_array($callable, array($value, $object)); }); });

		return $this;
	}

	public function stop()
	{
		$this->values->stop();

		return $this;
	}

	public function ifNotStopped(callable $callable)
	{
		$this->values->ifNotStopped($callable);

		return $this;
	}
}
