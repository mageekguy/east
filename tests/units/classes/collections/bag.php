<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world
;

class bag extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\collections\bag');
	}

	public function testAdd()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable()
			)

			->if($this->calling($comparable1)->ifIdenticalTo->doesNothing)
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->ifIdenticalTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->ifIdenticalTo->doesNothing)
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(2)
		;
	}

	public function testRemove()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->remove($comparable = new world\comparable()))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->calling($comparable)->ifIdenticalTo->doesNothing,
				$this->testedInstance->add($comparable),
				$this->calling($comparable)->ifIdenticalTo = function($comparable, $callable) { $callable(); }
			)
			->then
				->object($this->testedInstance->remove($comparable))->isTestedInstance
				->sizeof($this->testedInstance)->isZero
		;
	}

	public function testApply()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->apply(rand(- PHP_INT_MAX, PHP_INT_MAX), function($value, $key) use (& $innerValue) { $innerValue = $value; $innerKey = $key; }))->isTestedInstance
				->variable($innerValue)->isNull

			->if($this->testedInstance->add($comparable = new world\comparable()))
			->then
				->object($this->testedInstance->apply(0, function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->object($innerValue)->isIdenticalTo($comparable)
		;
	}

	public function testIfContains()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->ifContains($comparable = new world\comparable(), function() use (& $contains) { $contains = true; }))->isTestedInstance
				->variable($contains)->isNull

				->object($this->testedInstance->ifContains($comparable, function() use (& $contains) { $contains = true; }, function() use (& $contains) { $contains = false; }))->isTestedInstance
				->boolean($contains)->isFalse

			->if(
				$this->calling($comparable)->ifIdenticalTo->doesNothing,
				$this->testedInstance->add($comparable),
				$this->calling($comparable)->ifIdenticalTo = function($comparable, $callable) { $callable(); }
			)
			->then
				->object($this->testedInstance->ifContains($comparable, function() use (& $contains) { $contains = true; }, function() use (& $contains) { $contains = false; }))->isTestedInstance
				->boolean($contains)->isTrue

			->if($this->calling($comparable)->ifIdenticalTo->doesNothing)
			->then
				->object($this->testedInstance->ifContains($comparable, function() use (& $contains) { $contains = true; }, function() use (& $contains) { $contains = false; }))->isTestedInstance
				->boolean($contains)->isFalse
		;
	}
}
