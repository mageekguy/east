<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean,
	mock\jobs\world\object,
	mock\jobs\world\objects
;

class box extends \atoum
{
	public function testUserOpen()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->userOpen(new objects\box\user()))->isEqualTo(new boolean\true())
		;
	}

	public function testUserClose()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->userClose(new objects\box\user()))->isEqualTo(new boolean\true())
		;
	}

	public function testUserAdd()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)

			->if($this->calling($user)->openBox = new boolean\false())
			->then
				->object($this->testedInstance->userAdd($user, new object()))->isTestedInstance

			->if($this->calling($user)->openBox = $true = new boolean\true())
			->then
				->object($this->testedInstance->userAdd($user, new object()))->isTestedInstance
		;
	}

	public function testUserRemove()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)

			->if($this->calling($user)->openBox = new boolean\false())
			->then
				->object($this->testedInstance->userRemove($user, 1))->isTestedInstance

				->object($this->testedInstance->userRemove($user, 1))->isTestedInstance

				->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->variable($removedObject)->isNull

				->if($this->testedInstance->userAdd($user, $object = new object()))
				->then
					->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
					->variable($removedObject)->isNull

			->if($this->calling($user)->openBox = $true = new boolean\true())
			->then
				->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->variable($removedObject)->isNull

			->if($this->testedInstance->userAdd($user, $object = new object()))
			->then
				->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->object($removedObject)->isIdenticalTo($object)

			->if(
				$object0 = new object(),
				$this->calling($object0)->isIdenticalTo = new boolean\false(),

				$object1 = new object(),
				$this->calling($object1)->isIdenticalTo = new boolean\false(),

				$object2 = new object(),
				$this->calling($object2)->isIdenticalTo = new boolean\false(),

				$this->testedInstance
					->userAdd($user, $object0)
					->userAdd($user, $object1)
					->userAdd($user, $object2)
			)
			->then
				->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->object($removedObject)->isIdenticalTo($object2)

				->object($this->testedInstance->userRemove($user, 2, function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
				->array($removedObjects)->isIdenticalTo([ $object1, $object0 ])
		;
	}

	public function testUserRemoveAll()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)

			->if($this->calling($user)->openBox = new boolean\false())
			->then
				->object($this->testedInstance->userRemoveAll($user))->isTestedInstance

				->object($this->testedInstance->userRemoveAll($user, function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
				->variable($removedObjects)->isNull

			->if(
				$this->calling($user)->openBox = new boolean\true(),

				$object0 = new object(),
				$this->calling($object0)->isIdenticalTo = new boolean\false(),

				$object1 = new object(),
				$this->calling($object1)->isIdenticalTo = new boolean\false(),

				$object2 = new object(),
				$this->calling($object2)->isIdenticalTo = new boolean\false(),

				$this->testedInstance
					->userAdd($user, $object0)
					->userAdd($user, $object1)
					->userAdd($user, $object2)
			)
			->then
				->object($this->testedInstance->userRemoveAll($user, function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
				->array($removedObjects)->isIdenticalTo([ $object0, $object1, $object2 ])
		;
	}
}
