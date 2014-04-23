<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

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
				$key = new \mock\jobs\world\objects\key()
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
				$key = new \mock\jobs\world\objects\key()
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
}
