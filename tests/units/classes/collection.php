<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

class collection extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\collection');
	}

	public function test__construct()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->sizeof($this->testedInstance)->isZero
		;
	}

	public function testAdd()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add(uniqid()))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

				->object($this->testedInstance->add(uniqid(), uniqid()))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(2)

				->object($this->testedInstance->add(uniqid(), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(3)

		;
	}

	public function testRemove()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->remove(uniqid()))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if($this->testedInstance->add(uniqid()))
			->then
				->object($this->testedInstance->remove(0))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->testedInstance->add(uniqid()),
				$this->testedInstance->add(uniqid(), $key = uniqid())
			)
			->then
				->object($this->testedInstance->remove($key))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if(
				$this->testedInstance->add($value1 = uniqid(), $key1 = uniqid()),
				$this->testedInstance->add($value2 = uniqid(), $key2 = uniqid())
			)
			->then
				->object($this->testedInstance->remove($key2, function($value) use (& $removedValue) { $removedValue = $value; }))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(2)
				->string($removedValue)->isEqualTo($value2)

				->object($this->testedInstance->remove($key1, function($value) use (& $removedValue) { $removedValue = $value; }))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)
				->string($removedValue)->isEqualTo($value1)
		;
	}

	public function testRemoveLast()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if($this->testedInstance->add(uniqid()))
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->testedInstance
					->add($value0 = uniqid())
					->add($value1 = uniqid(), uniqid())
					->add($value2 = uniqid())
			)
			->then
				->object($this->testedInstance->removeLast(function($value) use (& $removedValue) { $removedValue = $value; }))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(2)
				->string($removedValue)->isEqualTo($value2)

				->object($this->testedInstance->removeLast(function($value) use (& $removedValue) { $removedValue = $value; }))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)
				->string($removedValue)->isEqualTo($value1)

				->object($this->testedInstance->removeLast(function($value) use (& $removedValue) { $removedValue = $value; }))->isTestedInstance
				->sizeof($this->testedInstance)->isZero
				->string($removedValue)->isEqualTo($value0)

			->if(
				$this->testedInstance
					->add($value0 = uniqid())
					->add($value1 = uniqid(), uniqid())
					->add($value2 = uniqid())
			)
			->then
				->object($this->testedInstance->removeLast(function($value) use (& $removedValues) { $removedValues[] = $value; }, 2))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)
				->array($removedValues)->isEqualTo([ $value2, $value1 ])
		;
	}

	public function testWalk()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->walk(function($value, $key) use (& $innerValue1, & $innerKey1) { $innerValue1 = $value; $innerKey1 = $key; }))->isTestedInstance
				->variable($innerValue1)->isNull
				->variable($innerKey1)->isNull

			->if($this->testedInstance->add($value1 = uniqid()))
			->then
				->object($this->testedInstance->walk(function($value, $key) use (& $innerValues, & $innerKeys) { $innerValues[] = $value; $innerKeys[] = $key; }))->isTestedInstance
				->array($innerValues)->isEqualTo(array($value1))
				->array($innerKeys)->isEqualTo(array(0))

			->if(
				$this->testedInstance->add($value2 = uniqid(), $key2 = uniqid()),
				$innerKeys = array(),
				$innerValues = array()
			)
			->then
				->object($this->testedInstance->walk(function($value, $key) use (& $innerValues, & $innerKeys) { $innerValues[] = $value; $innerKeys[] = $key; }))->isTestedInstance
				->array($innerValues)->isEqualTo(array($value1, $value2))
				->array($innerKeys)->isEqualTo(array(0, $key2))

			->if(
				$innerKeys = array(),
				$innerValues = array()
			)
			->then
				->object($this->testedInstance->walk(function($value, $key) use (& $innerValues, & $innerKeys) { $innerValues[] = $value; $innerKeys[] = $key; $this->testedInstance->stop(); }))->isTestedInstance
				->array($innerValues)->isEqualTo(array($value1))
				->array($innerKeys)->isEqualTo(array(0))
		;
	}

	public function testApply()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->apply(rand(- PHP_INT_MAX, PHP_INT_MAX), function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->variable($innerValue)->isNull
				->object($this->testedInstance->apply(uniqid(), function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->variable($innerValue)->isNull

			->if($this->testedInstance->add($value1 = uniqid()))
			->then
				->object($this->testedInstance->apply(rand(- PHP_INT_MAX, -1), function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->variable($innerValue)->isNull
				->object($this->testedInstance->apply(rand(1, PHP_INT_MAX), function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->variable($innerValue)->isNull
				->object($this->testedInstance->apply(0, function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->string($innerValue)->isEqualTo($value1)

			->given($innerValue = null)
			->if($this->testedInstance->add($value2 = uniqid(), $key = uniqid()))
			->then
				->object($this->testedInstance->apply(rand(- PHP_INT_MAX, -1), function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->variable($innerValue)->isNull
				->object($this->testedInstance->apply(rand(1, PHP_INT_MAX), function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->variable($innerValue)->isNull
				->object($this->testedInstance->apply(0, function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->string($innerValue)->isEqualTo($value1)
				->object($this->testedInstance->apply($key, function($value) use (& $innerValue) { $innerValue = $value; }))->isTestedInstance
				->string($innerValue)->isEqualTo($value2)
		;
	}

	public function testStop()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->stop())->isTestedInstance
		;
	}

	public function testIfIsNotStopped()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->ifNotStopped(function() use (& $stopped) { $stopped = true; }))->isTestedInstance
				->boolean($stopped)->isTrue

			->if($this->testedInstance->add(uniqid()))
			->then
				->object($this->testedInstance->ifNotStopped(function() use (& $stopped) { $stopped = true; }))->isTestedInstance
				->boolean($stopped)->isTrue

			->if($this->testedInstance->walk(function() {}))
			->then
				->object($this->testedInstance->ifNotStopped(function() use (& $stopped) { $stopped = true; }))->isTestedInstance
				->boolean($stopped)->isTrue

			->if(
				$this->testedInstance->walk(function() { $this->testedInstance->stop(); }),
				$stopped = false
			)
			->then
				->object($this->testedInstance->ifNotStopped(function() use (& $stopped) { $stopped = true; }))->isTestedInstance
				->boolean($stopped)->isFalse
		;
	}
}
