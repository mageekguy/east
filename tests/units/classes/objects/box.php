<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
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
				->object($this->testedInstance->userOpen(new objects\box\user(), function() use (& $isOpen) { $isOpen = true; }))->isTestedInstance
				->boolean($isOpen)->isTrue
		;
	}

	public function testUserClose()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->userClose(new objects\box\user(), function() use (& $isClose) { $isClose = true; }))->isTestedInstance
				->boolean($isClose)->isTrue
		;
	}

	public function testUserAdd()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->userAdd(new objects\box\user(), new object()))->isTestedInstance
		;
	}

	public function testUserRemove()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)

			->if($this->calling($user)->openBox = function($box, $callable) { $callable(); })
			->then
				->object($this->testedInstance->userRemove($user, 1))->isTestedInstance

				->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
				->variable($removedObject)->isNull

				->if($this->testedInstance->userAdd($user, $object = new object()))
				->then
					->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
					->object($removedObject)->isIdenticalTo($object)

				->if(
					$this->testedInstance
						->userAdd($user, $object0 = new object())
						->userAdd($user, $object1 = new object())
						->userAdd($user, $object2 = new object())
				)
				->then
					->object($this->testedInstance->userRemove($user, 1, function($object) use (& $removedObject) { $removedObject = $object; }))->isTestedInstance
					->object($removedObject)->isIdenticalTo($object2)

					->object($this->testedInstance->userRemove($user, 2, function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
					->array($removedObjects)->isIdenticalTo([ $object1, $object0 ])

			->if(
				$this->testedInstance
					->userAdd($user, $object0 = new object())
					->userAdd($user, $object1 = new object())
					->userAdd($user, $object2 = new object()),
				$this->calling($user)->openBox->doesNothing
			)
			->then
				->object($this->testedInstance->userRemove($user, 1))->isTestedInstance

				->if($this->testedInstance->userAdd($user, $object = new object()))
				->then
					->object($this->testedInstance->userRemove($user, 1, function($object) use (& $notRemovedObject) { $notRemovedObject = $object; }))->isTestedInstance
					->variable($notRemovedObject)->isNull

					->object($this->testedInstance->userRemove($user, 2, function($object) use (& $notRemovedObjects) { $notRemovedObjects[] = $object; }))->isTestedInstance
					->variable($notRemovedObjects)->isNull
		;
	}

	public function testUserRemoveAll()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)
			->if($this->calling($user)->openBox = function($box, $callable) { $callable(); })
			->then
				->object($this->testedInstance->userRemoveAll($user))->isTestedInstance

				->object($this->testedInstance->userRemoveAll($user, function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
				->variable($removedObjects)->isNull

				->if(
					$this->testedInstance
						->userAdd($user, $object0 = new object())
						->userAdd($user, $object1 = new object())
						->userAdd($user, $object2 = new object())
				)
				->then
					->object($this->testedInstance->userRemoveAll($user, function($object) use (& $removedObjects) { $removedObjects[] = $object; }))->isTestedInstance
					->array($removedObjects)->isIdenticalTo([ $object0, $object1, $object2 ])
		;
	}
}
