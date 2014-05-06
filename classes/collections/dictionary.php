<?php

namespace jobs\collections;

use
	jobs\boolean,
	jobs\collection as valuesCollection,
	jobs\collections\set as objectsCollection,
	jobs\world\comparable,
	jobs\world\collections
;

class dictionary implements collections\dictionary
{
	private $objects = null;
	private $values = null;

	function __construct()
	{
		$this->objects = new objectsCollection();
		$this->values = new valuesCollection();
	}

	function hasSize($size)
	{
		return $this->objects->hasSize($size);
	}

	function isEmpty()
	{
		return $this->hasSize(0);
	}

	function add(comparable $object, $value)
	{
		$this
			->objects
				->applyOn($object, function($object, $key) use ($value) {
						$this->values->add($value, $key);
					}
				)
					->ifFalse(function() use ($object, $value) {
							$this->objects->add($object);
							$this->values->add($value);
						}
					)
		;

		return $this;
	}

	function remove(comparable $object)
	{
		$this
			->objects
				->walk(function($innerObject, $key) use (& $keyValue, $object) {
						return $object->isEqualTo($innerObject)
							->ifTrue(function() use (& $keyValue, $key) {
									$keyValue  = $key;
								}
							)
								->not();
					}
				)
					->ifFalse(function() use ($keyValue, $object) {
							$this->objects->remove($object);
							$this->values->remove($keyValue);
						}
					)
		;

		return $this;
	}

	function apply(comparable $object, callable $callable)
	{
		return $this
			->objects
				->isNotEmpty()
					->ifTrue(function() use ($object, $callable) {
							return $this
								->objects
									->walk(function($innerObject, $key) use (& $keyValue, $object, $callable) {
											return $object
												->isEqualTo($innerObject)
													->ifTrue(function() use (& $keyValue, $key, $callable) {
															$keyValue = $key;
														}
													)
														->not()
											;
										}
									)
										->ifFalse(function() use ($keyValue, $callable) {
												return $this->values->apply($keyValue, $callable);
											}
										)
							;
						}
					)
		;
	}

	function contains($value)
	{
		return $this
			->values
				->contains($comparable)
		;
	}

	function containsAt($value, comparable $object)
	{
		return $this
			->objects
				->applyOn($object, function($object, $key) use ($value) {
						return $this->values->containsAt($value, $key);
					}
				)
		;
	}

	function walk(callable $callable)
	{
		return $this->values->walk(function($value, $key) use ($callable) {
				$this
					->objects
						->apply($key, function($object) use ($value, $callable) {
								return $callable($value, $object);
							}
						)
				;
			}
		);
	}
}
