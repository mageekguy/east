<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean,
	jobs\tests\units,
	mock\jobs\world\object,
	mock\jobs\world\objects,
	mock\jobs\world\comparable
;

class box extends units\test
{
	function testIsEqualTo()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->isEqualTo($this->testedInstance))->isTrue
				->boolean($this->testedInstance->isEqualTo(clone $this->testedInstance))->isTrue
				->boolean($this->testedInstance->isEqualTo(new comparable))->isFalse
		;
	}

	function testIsIdenticalTo()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->isIdenticalTo($this->testedInstance))->isTrue
				->boolean($this->testedInstance->isIdenticalTo(clone $this->testedInstance))->isFalse
				->boolean($this->testedInstance->isIdenticalTo(new comparable))->isFalse
		;
	}

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

	public function testUserAddObject()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)

			->if($this->calling($user)->openBox = new boolean\false())
			->then
				->object($this->testedInstance->userAddObject($user, new object()))->isTestedInstance

			->if($this->calling($user)->openBox = $true = new boolean\true())
			->then
				->object($this->testedInstance->userAddObject($user, new object()))->isTestedInstance
		;
	}

	public function testUserRemoveObject()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)

			->if($this->calling($user)->openBox = new boolean\false())
			->then
				->object($this->testedInstance->userRemoveObject($user))->isTestedInstance

			->if($this->calling($user)->openBox = $true = new boolean\true())
			->then
				->object($this->testedInstance->userRemoveObject($user))->isTestedInstance

			->if(
				$object0 = new object(),
				$this->calling($object0)->isIdenticalTo = new boolean\false(),

				$object1 = new object(),
				$this->calling($object1)->isIdenticalTo = new boolean\false(),

				$object2 = new object(),
				$this->calling($object2)->isIdenticalTo = new boolean\false(),

				$this->testedInstance
					->userAddObject($user, $object0)
					->userAddObject($user, $object1)
					->userAddObject($user, $object2)
			)
			->then
				->object($this->testedInstance->userRemoveObject($user))->isTestedInstance
				->object($this->testedInstance->userRemoveObject($user))->isTestedInstance
				->object($this->testedInstance->userRemoveObject($user))->isTestedInstance
				->object($this->testedInstance->userRemoveObject($user))->isTestedInstance
		;
	}

	public function testUserRemoveObjects()
	{
		$this
			->given(
				$this->newTestedInstance,
				$user = new objects\box\user()
			)

			->if($this->calling($user)->openBox = new boolean\false())
			->then
				->object($this->testedInstance->userRemoveObjects($user))->isTestedInstance

			->if(
				$this->calling($user)->openBox = new boolean\true(),

				$object0 = new object(),
				$this->calling($object0)->isIdenticalTo = new boolean\false(),

				$object1 = new object(),
				$this->calling($object1)->isIdenticalTo = new boolean\false(),

				$object2 = new object(),
				$this->calling($object2)->isIdenticalTo = new boolean\false(),

				$this->testedInstance
					->userAddObject($user, $object0)
					->userAddObject($user, $object1)
					->userAddObject($user, $object2)
			)
			->then
				->object($this->testedInstance->userRemoveObjects($user))->isTestedInstance
		;
	}
}
