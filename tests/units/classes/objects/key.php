<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world,
	mock\jobs\world\objects
;

class key extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\objects\key');
	}

	public function testIfEqualTo()
	{
		$this
			->given(
				$this->newTestedInstance,
				$key = new objects\key()
			)
			->then
				->object($this->testedInstance->ifEqualTo($key, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->variable($isEqualTo)->isNull

				->object($this->testedInstance->ifEqualTo($this->testedInstance, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->boolean($isEqualTo)->isTrue

				->object($this->testedInstance->ifEqualTo(clone $this->testedInstance, function() use (& $cloneIsEqualTo) { $cloneIsEqualTo = true; }))->isTestedInstance
				->boolean($cloneIsEqualTo)->isTrue
		;
	}

	public function testIfIdenticalTo()
	{
		$this
			->given(
				$this->newTestedInstance,
				$key = new objects\key()
			)
			->then
				->object($this->testedInstance->ifIdenticalTo($key, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->variable($isEqualTo)->isNull

				->object($this->testedInstance->ifIdenticalTo($this->testedInstance, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->boolean($isEqualTo)->isTrue
		;
	}
}
