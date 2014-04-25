<?php

namespace jobs\tests\functionals;

require __DIR__ . '/runner.php';

use
	jobs\world,
	jobs\objects\box
;

class object implements world\object
{
	static $objects = 0;

	public function __construct()
	{
		static::$objects++;

		$this->name = static::$objects;
	}

	public function __toString()
	{
		return 'object ' . $this->name;
	}

	public function ifEqualTo(world\comparable $object, callable $callable)
	{
		return $this == $object;
	}

	public function ifIdenticalTo(world\comparable $object, callable $callable)
	{
		return $this === $object;
	}
}

(new box())
	->add(new object())
	->add(new object())
	->add(new object())
	->add(new object())
	->add(new object())
	->remove(1, function($object) { echo $object . PHP_EOL; })
	->remove(2, function($object) { echo $object . PHP_EOL; })
	->removeAll(function($object) { echo $object . PHP_EOL; })
;
