<?php

namespace jobs;

use
	jobs\world,
	jobs\boolean
;

class collection implements world\collection
{
	private $values = [];

	function isEmpty()
	{
		return $this->hasSize(0);
	}

	function hasSize($size)
	{
		return new boolean(sizeof($this->values) == $size);
	}

	function isNotEmpty()
	{
		return $this
			->isEmpty()
				->not()
		;
	}

	function add($value, $key = null)
	{
		(new boolean($key === null))
			->ifTrue(function() use (& $key) {
					$key = sizeof($this->values);
				}
			)
		;

		$this->values[$key] = $value;

		return $this;
	}

	function remove($key)
	{
		(new boolean(isset($this->values[$key])))
			->ifTrue(function() use ($key) {
					unset($this->values[$key]);
				}
			)
		;

		return $this;
	}

	function removeLast()
	{
		end($this->values);

		return $this->remove(key($this->values));
	}

	function contains($value)
	{
		return $this
			->walk(function($innerValue) use ($value) {
					return new boolean($value != $innerValue);
				}
			)
				->not()
		;
	}

	function containsAt($value, $key)
	{
		return $this
			->walk(function($innerValue, $innerKey) use ($value, $key) {
					return new boolean($innerKey != $key || $value != $innerValue);
				}
			)
				->not()
		;
	}

	function walk(callable $callable)
	{
		return $this
			->isEmpty()
				->ifFalse(function() use ($callable) {
						$break = false;

						reset($this
							->values
						);

						while ($break === false && list($key, $value) = each($this->values))
						{
							$this
								->executeIfBoolean($callable($value, $key), function($boolean) use (& $break) {
										$boolean
											->ifFalse(function() use (& $break) {
													$break = true;
												}
											)
										;
									}
								)
							;
						}

						return new boolean($break === false);
					}
				)
		;
	}

	function apply($key, callable $callable)
	{
		return (new boolean(isset($this->values[$key])))
			->ifTrue(function() use ($key, $callable) {
					return $callable($this->values[$key], $key);
				}
			)
		;
	}

	function filter(callable $callable)
	{
		return $this
			->isEmpty()
				->ifFalse(function() use ($callable) {
						$values = $this->values;
						$this->values = [];

						foreach ($values as $key => $value)
						{
							$this
								->executeIfBoolean($callable($value, $key), function($boolean) use ($value, $key) {
										$boolean->ifTrue(function() use ($value, $key) {
												$this->add($value, $key);
											}
										);
									}
								)
							;
						}

						return new boolean(sizeof($values) != sizeof($this->values));
					}
				)
		;
	}

	private function executeIfBoolean($value, callable $booleanCallable)
	{
		if ($value instanceof boolean)
		{
			$booleanCallable($value);
		}

		return $this;
	}
}
