<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world\object
;

class box extends \atoum
{
	public function testAdd()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add(new object()))->isTestedInstance
		;
	}

	public function testRemove()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->remove(1))->isTestedInstance

				->object($this->testedInstance->remove(1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->variable($removedObject)->isNull

			->if($this->testedInstance
					->add($object = new object())
			)
			->then
				->object($this->testedInstance->remove(1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->object($removedObject)->isIdenticalTo($object)

			->if(
				$this->testedInstance
					->add($object0 = new object())
					->add($object1 = new object())
					->add($object2 = new object())
			)
			->then
				->object($this->testedInstance->remove(1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->object($removedObject)->isIdenticalTo($object2)

				->object($this->testedInstance->remove(2, function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
				->array($removedObjects)->isIdenticalTo([ $object1, $object0 ])
		;
	}

	public function testRemoveAll()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->removeAll())->isTestedInstance

				->object($this->testedInstance->removeAll(function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
				->variable($removedObjects)->isNull

			->if(
				$this->testedInstance
					->add($object0 = new object())
					->add($object1 = new object())
					->add($object2 = new object())
			)
			->then
				->object($this->testedInstance->removeAll(function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
				->array($removedObjects)->isIdenticalTo([ $object0, $object1, $object2 ])
		;
	}
}
