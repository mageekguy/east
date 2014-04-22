<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world\comparable
;

class dictionary extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\collections\dictionary');
	}

	public function testAdd()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add($comparable1 = new comparable(), uniqid()))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->ifEqualTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->add($comparable1, uniqid()))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->ifEqualTo->doesNothing)
			->then
				->object($this->testedInstance->add($comparable2 = new comparable(), uniqid()))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(2)
		;
	}

	public function testRemove()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->remove($comparable = new comparable()))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->calling($comparable)->ifEqualTo->doesNothing,
				$this->testedInstance->add($comparable, uniqid()),
				$this->calling($comparable)->ifEqualTo = function($comparable, $callable) { $callable(); }
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
				->object($this->testedInstance->apply($comparable = new comparable(), function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->variable($innerValue)->isNull

			->if(
				$this->testedInstance->add($comparable, $value = uniqid()),
				$this->calling($comparable)->ifEqualTo = function($comparable, $callable) { $callable(); }
			)
			->then
				->object($this->testedInstance->apply($comparable, function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->string($innerValue)->isEqualTo($value)
		;
	}

	public function testWalk()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->walk(function($value, $key) use (& $innerValue, & $innerKey) { $innerValue = $value; $innerKey = $key; }))->isTestedInstance
				->variable($innerValue)->isNull
				->variable($innerKey)->isNull

			->if($this->testedInstance->add($comparable = new comparable(), $value = uniqid()))
			->then
				->object($this->testedInstance->walk(function($value, $key) use (& $innerValue, & $innerKey) { $innerValue = $value; $innerKey = $key; }))->isTestedInstance
				->string($innerValue)->isEqualTo($value)
				->object($innerKey)->isIdenticalTo($comparable)
		;
	}
}
