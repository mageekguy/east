<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
	jobs\boolean,
	jobs\tests\units,
	mock\jobs\world\object,
	mock\jobs\world\objects\door
;

class area extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\area');
	}

	function testObjectEnter()
	{
		$this
			->given(
				$this->newTestedInstance,
				$object = new object
			)

			->if($this->calling($object)->isIdenticalTo = function($anObject) use ($object) { return new boolean($object === $anObject); })
			->then
				->object($this->testedInstance->objectEnter($object))
					->isTestedInstance
				->mock($object)
					->call('enterInArea')->withIdenticalArguments($this->testedInstance)->once
				->boolean($this->testedInstance->containsObject($object))
					->isTrue
				->boolean($this->testedInstance->numberOfObjectsIs(1))
					->isTrue

				->object($this->testedInstance->objectEnter($object))
					->isTestedInstance
				->mock($object)
					->call('enterInArea')->withIdenticalArguments($this->testedInstance)->once
				->boolean($this->testedInstance->containsObject($object))
					->isTrue
				->boolean($this->testedInstance->numberOfObjectsIs(1))
					->isTrue
		;
	}

	function testObjectLeave()
	{
		$this
			->given(
				$this->newTestedInstance,
				$object = new object
			)

			->if($this->calling($object)->isIdenticalTo = function($anObject) use ($object) { return new boolean($object === $anObject); })
			->then
				->object($this->testedInstance->objectLeave($object))->isTestedInstance
				->boolean($this->testedInstance->containsObject($object))
					->isFalse

			->if($this->testedInstance->objectEnter($object))
			->then
				->object($this->testedInstance->objectLeave($object))->isTestedInstance
				->boolean($this->testedInstance->containsObject($object))
					->isFalse
				->boolean($this->testedInstance->numberOfObjectsIs(1))
					->isFalse
		;
	}

	function testAddDoor()
	{
		$this
			->given(
				$this->newTestedInstance,
				$door = new door
			)

			->if($this->calling($door)->isIdenticalTo = function($aDoor) use ($door) { return new boolean($door === $aDoor); })
			->then
				->object($this->testedInstance->addDoor($door))
					->isTestedInstance
				->mock($door)
					->call('enterInArea')->withIdenticalArguments($this->testedInstance)->once
				->boolean($this->testedInstance->hasDoor($door))
					->isTrue
				->boolean($this->testedInstance->numberOfDoorsIs(1))->isTrue

				->object($this->testedInstance->addDoor($door))
					->isTestedInstance
				->mock($door)
					->call('enterInArea')->withIdenticalArguments($this->testedInstance)->once
				->boolean($this->testedInstance->hasDoor($door))
					->isTrue
				->boolean($this->testedInstance->numberOfDoorsIs(1))->isTrue

			->if($this->testedInstance->objectEnter($door))
			->then
				->object($this->testedInstance->addDoor($door))
					->isTestedInstance
				->mock($door)
					->call('enterInArea')->withIdenticalArguments($this->testedInstance)->once
				->boolean($this->testedInstance->hasDoor($door))
					->isTrue
				->boolean($this->testedInstance->numberOfDoorsIs(1))->isTrue
		;
	}
}
