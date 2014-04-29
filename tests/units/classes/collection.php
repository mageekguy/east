<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
	jobs
;

class collection extends test
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
				->boolean($this->testedInstance->isEmpty())->isTrue
		;
	}

	public function testIsEmpty()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->isEmpty())->isTrue

			->if($this->testedInstance->add(uniqid()))
			->then
				->boolean($this->testedInstance->isEmpty())->isFalse
		;
	}

	public function testIsNotEmpty()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->isNotEmpty())->isFalse

			->if($this->testedInstance->add(uniqid()))
			->then
				->boolean($this->testedInstance->isNotEmpty())->isTrue
		;
	}

	public function testHasSize()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->hasSize(0))->isTrue
				->boolean($this->testedInstance->hasSize(rand(- PHP_INT_MAX, -1)))->isFalse
				->boolean($this->testedInstance->hasSize(rand(1, PHP_INT_MAX)))->isFalse

			->if($this->testedInstance->add(uniqid()))
			->then
				->boolean($this->testedInstance->hasSize(0))->isFalse
				->boolean($this->testedInstance->hasSize(1))->isTrue
				->boolean($this->testedInstance->hasSize(rand(- PHP_INT_MAX, 0)))->isFalse
				->boolean($this->testedInstance->hasSize(rand(2, PHP_INT_MAX)))->isFalse

			->if($this->testedInstance->add(uniqid()))
			->then
				->boolean($this->testedInstance->hasSize(0))->isFalse
				->boolean($this->testedInstance->hasSize(1))->isFalse
				->boolean($this->testedInstance->hasSize(2))->isTrue
				->boolean($this->testedInstance->hasSize(rand(- PHP_INT_MAX, 1)))->isFalse
				->boolean($this->testedInstance->hasSize(rand(3, PHP_INT_MAX)))->isFalse
		;
	}

	public function testAdd()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add($value1 = uniqid()))->isTestedInstance
				->boolean($this->testedInstance->containsAt($value1, 0))->isTrue

				->object($this->testedInstance->add($value2 = uniqid(), $key2 = uniqid()))->isTestedInstance
				->boolean($this->testedInstance->containsAt($value2, $key2))->isTrue

				->object($this->testedInstance->add($value3 = uniqid(), $key3 = rand(- PHP_INT_MAX, PHP_INT_MAX)))->isTestedInstance
				->boolean($this->testedInstance->containsAt($value3, $key3))->isTrue
		;
	}

	public function testRemove()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->remove(uniqid()))->isTestedInstance

				->object($this->testedInstance->remove(rand(- PHP_INT_MAX, PHP_INT_MAX)))->isTestedInstance

			->if(
				$this->testedInstance->add($value1 = uniqid()),
				$this->testedInstance->add($value2 = uniqid(), $key2 = 5),
				$this->testedInstance->add($value3 = uniqid(), $key3 = uniqid())
			)
			->then
				->object($this->testedInstance->remove(0))->isTestedInstance
				->boolean($this->testedInstance->contains($value1))->isFalse
				->boolean($this->testedInstance->containsAt($value2, $key2))->isTrue
				->boolean($this->testedInstance->containsAt($value3, $key3))->isTrue

				->object($this->testedInstance->remove(0))->isTestedInstance
				->boolean($this->testedInstance->contains($value1))->isFalse
				->boolean($this->testedInstance->containsAt($value2, $key2))->isTrue
				->boolean($this->testedInstance->containsAt($value3, $key3))->isTrue

				->object($this->testedInstance->remove($key3))->isTestedInstance
				->boolean($this->testedInstance->contains($value1))->isFalse
				->boolean($this->testedInstance->containsAt($value2, $key2))->isTrue
				->boolean($this->testedInstance->containsAt($value3, $key3))->isFalse

				->object($this->testedInstance->remove($key2))->isTestedInstance
				->boolean($this->testedInstance->contains($value1))->isFalse
				->boolean($this->testedInstance->containsAt($value2, $key2))->isFalse
				->boolean($this->testedInstance->containsAt($value3, $key3))->isFalse
		;
	}

	public function testRemoveLast()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance

			->if($this->testedInstance->add(uniqid()))
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance
				->boolean($this->testedInstance->isEmpty())->isTrue

			->if(
				$this->testedInstance->add($value1 = uniqid()),
				$this->testedInstance->add($value2 = uniqid()),
				$this->testedInstance->add($value3 = uniqid())
			)
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance
				->boolean($this->testedInstance->contains($value3))->isFalse
				->boolean($this->testedInstance->contains($value2))->isTrue
				->boolean($this->testedInstance->contains($value1))->isTrue

				->object($this->testedInstance->removeLast())->isTestedInstance
				->boolean($this->testedInstance->contains($value3))->isFalse
				->boolean($this->testedInstance->contains($value2))->isFalse
				->boolean($this->testedInstance->contains($value1))->isTrue

				->object($this->testedInstance->removeLast())->isTestedInstance
				->boolean($this->testedInstance->contains($value3))->isFalse
				->boolean($this->testedInstance->contains($value2))->isFalse
				->boolean($this->testedInstance->contains($value1))->isFalse
		;
	}

	public function testContains()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->contains(uniqid()))->isFalse

			->if($this->testedInstance->add($value = uniqid()))
			->then
				->boolean($this->testedInstance->contains(uniqid()))->isFalse
				->boolean($this->testedInstance->contains($value))->isTrue
		;
	}

	public function testContainsAt()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->containsAt(uniqid(), uniqid()))->isFalse
				->boolean($this->testedInstance->containsAt(uniqid(), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isFalse

			->if($this->testedInstance->add($value1 = uniqid()))
			->then
				->boolean($this->testedInstance->containsAt(uniqid(), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isFalse
				->boolean($this->testedInstance->containsAt($value1, 0))->isTrue
				->boolean($this->testedInstance->containsAt($value1, uniqid()))->isFalse
				->boolean($this->testedInstance->containsAt($value1, rand(- PHP_INT_MAX, -1)))->isFalse
				->boolean($this->testedInstance->containsAt($value1, rand(1, PHP_INT_MAX)))->isFalse

			->if($this->testedInstance->add($value2 = uniqid(), $key2 = uniqid()))
			->then
				->boolean($this->testedInstance->containsAt(uniqid(), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isFalse
				->boolean($this->testedInstance->containsAt($value1, 0))->isTrue
				->boolean($this->testedInstance->containsAt($value1, uniqid()))->isFalse
				->boolean($this->testedInstance->containsAt($value1, rand(- PHP_INT_MAX, -1)))->isFalse
				->boolean($this->testedInstance->containsAt($value1, rand(1, PHP_INT_MAX)))->isFalse
				->boolean($this->testedInstance->containsAt($value2, 0))->isFalse
				->boolean($this->testedInstance->containsAt($value2, $key2))->isTrue
				->boolean($this->testedInstance->containsAt($value2, uniqid()))->isFalse
				->boolean($this->testedInstance->containsAt($value2, rand(- PHP_INT_MAX, -1)))->isFalse
				->boolean($this->testedInstance->containsAt($value2, rand(1, PHP_INT_MAX)))->isFalse
		;
	}

	public function testWalk()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->walk(function() {}))->isTrue

			->if($this->testedInstance->add($value1 = uniqid()))
			->then
				->boolean($this->testedInstance->walk(function($value, $key) use (& $innerValues, & $innerKeys) { $innerValues[] = $value; $innerKeys[] = $key; }))->isTrue
				->array($innerValues)->isEqualTo(array($value1))
				->array($innerKeys)->isEqualTo(array(0))

			->if(
				$this->testedInstance->add($value2 = uniqid(), $key2 = uniqid()),
				$innerKeys = array(),
				$innerValues = array()
			)
			->then
				->boolean($this->testedInstance->walk(function($value, $key) use (& $innerValues, & $innerKeys) { $innerValues[] = $value; $innerKeys[] = $key; }))->isTrue
				->array($innerValues)->isEqualTo(array($value1, $value2))
				->array($innerKeys)->isEqualTo(array(0, $key2))

			->if(
				$this->testedInstance->add($value3 = uniqid(), $key3 = uniqid()),
				$innerKeys = array(),
				$innerValues = array()
			)
			->then
				->boolean($this->testedInstance->walk(function($value, $key) use (& $innerValues, & $innerKeys) { static $count = 0; $innerValues[] = $value; $innerKeys[] = $key; return new jobs\boolean($count++ != 1); }))->isFalse
				->array($innerValues)->isEqualTo(array($value1, $value2))
				->array($innerKeys)->isEqualTo(array(0, $key2))
		;
	}

	public function testApplyAt()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->apply(rand(- PHP_INT_MAX, PHP_INT_MAX), function() {}))->isFalse
				->boolean($this->testedInstance->apply(uniqid(), function() {}))->isFalse

			->if($this->testedInstance->add($value1 = uniqid()))
			->then
				->boolean($this->testedInstance->apply(rand(- PHP_INT_MAX, -1), function() {}))->isFalse
				->boolean($this->testedInstance->apply(rand(1, PHP_INT_MAX), function() {}))->isFalse
				->boolean($this->testedInstance->apply(0, function($value) use (& $innerValue) { $innerValue = $value; }))->isTrue
				->string($innerValue)->isEqualTo($value1)

			->if($this->testedInstance->add($value2 = uniqid(), $key = uniqid()))
			->then
				->boolean($this->testedInstance->apply(rand(- PHP_INT_MAX, -1), function() {}))->isFalse
				->boolean($this->testedInstance->apply(rand(1, PHP_INT_MAX), function() {}))->isFalse
				->boolean($this->testedInstance->apply(0, function($value) use (& $innerValue1) { $innerValue1 = $value; }))->isTrue
				->string($innerValue1)->isEqualTo($value1)
				->boolean($this->testedInstance->apply($key, function($value) use (& $innerValue2) { $innerValue2 = $value; }))->isTrue
				->string($innerValue2)->isEqualTo($value2)
		;
	}

	public function testFilter()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->filter(function() {}))->isTrue

			->if(
				$this->testedInstance->add($value1 = uniqid()),
				$this->testedInstance->add($value2 = uniqid()),
				$this->testedInstance->add($value3 = uniqid())
			)
			->then
				->boolean($this->testedInstance->filter(function() {}))->isTrue
				->boolean($this->testedInstance->isEmpty())->isTrue

			->if(
				$this->testedInstance->add($value1 = uniqid()),
				$this->testedInstance->add($value2 = uniqid()),
				$this->testedInstance->add($value3 = uniqid())
			)
			->then
				->boolean($this->testedInstance->filter(function() { return new jobs\boolean\true; }))->isFalse
				->boolean($this->testedInstance->containsAt($value1, 0))->isTrue
				->boolean($this->testedInstance->containsAt($value2, 1))->isTrue
				->boolean($this->testedInstance->containsAt($value3, 2))->isTrue

				->boolean($this->testedInstance->filter(function($value) use ($value2) { return new jobs\boolean($value != $value2); }))->isTrue
				->boolean($this->testedInstance->containsAt($value1, 0))->isTrue
				->boolean($this->testedInstance->containsAt($value2, 1))->isFalse
				->boolean($this->testedInstance->containsAt($value3, 2))->isTrue

				->boolean($this->testedInstance->filter(function() { return new jobs\boolean\false; }))->isTrue
				->boolean($this->testedInstance->isEmpty())->isTrue
		;
	}
}
