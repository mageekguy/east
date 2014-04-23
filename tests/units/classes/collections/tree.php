<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world\comparable
;

class tree extends \atoum
{
	public function testAdd()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add(new comparable(), new comparable(), new comparable()))->isTestedInstance
		;
	}

	public function testApply()
	{
		$this
			->given($this->newTestedInstance->add($name = new comparable(), $value = new comparable(), $object1 = new comparable()))

			->if(
				$this->calling($object1)->ifIdenticalTo->doesNothing,
				$this->calling($name)->ifEqualTo->doesNothing,
				$this->calling($value)->ifEqualTo->doesNothing
			)
			->then
				->object($this->testedInstance->apply($name, $value, function($object) use (& $innerObject) { $innerObject = $object; }))->isTestedInstance
				->variable($innerObject)->isNull

			->if($this->calling($name)->ifEqualTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->apply($name, $value, function($object) use (& $innerObject) { $innerObject = $object; }))->isTestedInstance
				->variable($innerObject)->isNull

			->if($this->calling($value)->ifEqualTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->apply($name, $value, function($object) use (& $innerObject) { $innerObject = $object; }))->isTestedInstance
				->object($innerObject)->isIdenticalTo($object1)

			->given(
				$object2 = new comparable(),
				$this->calling($object2)->ifIdenticalTo->doesNothing
			)
			->if($this->testedInstance->add($name, $value, $object2))
			->then
				->object($this->testedInstance->apply($name, $value, function($object) use (& $innerObjects) { $innerObjects[] = $object; }))->isTestedInstance
				->array($innerObjects)->isIdenticalTo([ $object1, $object2 ])
		;
	}
}
