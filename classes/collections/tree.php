<?php

namespace jobs\collections;

use
	jobs\collections\set,
	jobs\collections\bag,
	jobs\collections\dictionary,
	jobs\world\comparable,
	jobs\world\collections
;

class tree
{
	private $values = null;
	private $objects = null;

	public function __construct()
	{
		$this->values = new dictionary();
		$this->objects = new dictionary();
	}

	public function add(comparable $name, comparable $value, comparable $object)
	{
		$this->values->ifContains($name, function($values) use ($value, $object) {
				$values->ifContains($value, function($value) use ($object) {
						$this->objects->ifContains($value, function($objects) use ($object) {
								$objects->add($object);
							}
						);
					},
					function() use ($value, $object) {
						$this->objects->add($value, (new bag())->add($object));
					}
				);
			},
			function() use ($name, $value, $object) {
				$this->values->add($name, (new set())->add($value));
				$this->objects->add($value, (new bag())->add($object));
			}
		);

		return $this;
	}

	public function apply(comparable $name, comparable $value, callable $callable)
	{
		$this->values->ifContains($name, function($values) use ($value, $callable) {
				$values->ifContains($value, function($value) use ($callable) {
						$this->objects->apply($value, function($objects) use ($callable) {
								$objects->walk($callable);
							}
						);
					}
				);
			}
		);

		return $this;
	}
}
