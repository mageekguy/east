<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
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
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->objectEnter(new object()))->isTestedInstance
		;
	}

	function testObjectLeave()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->objectLeave(new object()))->isTestedInstance
		;
	}

	function testAddDoor()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addDoor(new door()))->isTestedInstance
		;
	}
}
