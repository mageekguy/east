<?php

namespace jobs\object;

use
	jobs\world\object\property
;

class properties
{
	private $values = null;

	function __construct()
	{
		$this->values = new dictionary();
	}

	function addProperty(property\name $name, property\value $value)
	{
		$this->values->ifContains($name, function($values) use ($value) {
				$values->ifContains($value, function() {}, function() use ($value, $values) { $values->add($value); });
			},
			function() use ($name, $value) {
				$this->values->add($name, (new set())->add($value));
			}
		);

		return $this;
	}

	function walk(callable $callable)
	{
		$this->values->walk(function($name, $values) use ($callable) {
				$values->walk(function($value) use ($name, $callable) {
						$callable($name, $value);
					}
				);
			}
		);

		return $this;
	}

	function ifContains(property\name $name, property\value $value, callable $containsCallable, callable $notContainsCallable = null)
	{
		if ($notContainsCallable === null)
		{
			$notContainsCallable = function() {};
		}

		$this->values->ifContains($name, function($values) use ($name, $value, $containsCallable, $notContainsCallable) {
				$values->ifContains($value, function($value) use ($name, $containsCallable) {
						$containsCallable($name, $value);
					},
					$notContainsCallable
				);
			},
			$notContainsCallable
		);
	}

	function ifContainsProperties(self $properties, callable $containsCallable, callable $notContainsCallable = null)
	{
		$properties->walk(function($name, $value) use ($notContainsCallable) {
				$this->ifContains($name, $value, function() {}, function() use ($properties, $notContainsCallable) { $properties->stop(); $notContainsCallable(); });
			}
		);

		$properties->ifNotStopped($containsCallable);

		return $this;
	}

	function stop()
	{
		$this->values->stop();

		return $this;
	}

	function ifNotStopped(callable $callable)
	{
		$this->values->ifNotStopped($callable);

		return $this;
	}
}
