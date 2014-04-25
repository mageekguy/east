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

			->if($this->calling($key)->ifEqualTo->doesNothing)
			->then
				->object($this->testedInstance->ifEqualTo($key, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->variable($isEqualTo)->isNull

			->if($this->calling($key)->ifEqualTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->ifEqualTo($key, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->boolean($isEqualTo)->isTrue
		;
	}

	public function testIfIdenticalTo()
	{
		$this
			->given(
				$this->newTestedInstance,
				$key = new objects\key()
			)

			->if($this->calling($key)->ifIdenticalTo->doesNothing)
			->then
				->object($this->testedInstance->ifIdenticalTo($key, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->variable($isEqualTo)->isNull

			->if($this->calling($key)->ifIdenticalTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->ifIdenticalTo($key, function() use (& $isEqualTo) { $isEqualTo = true; }))->isTestedInstance
				->boolean($isEqualTo)->isTrue
		;
	}

	public function testAddIn()
	{
		$this
			->given(
				$this->newTestedInstance,
				$area = new world\area()
			)
			->then
				->object($this->testedInstance->addIn($area))->isTestedInstance
		;
	}
}
