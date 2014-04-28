<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean,
	mock\jobs\world
;

class set extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\collections\set');
	}

	public function testAdd()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable()
			)

			->if($this->calling($comparable1)->isEqualTo = new boolean\false())
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->isEqualTo = new boolean\true())
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->isEqualTo = new boolean\false())
				->object($this->testedInstance->add($comparable1 = new world\comparable()))->isTestedInstance
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
				$this->calling($comparable)->isEqualTo = new boolean\false(),
				$this->testedInstance->add($comparable),
				$this->calling($comparable)->isEqualTo = new boolean\true()
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
				$this->calling($comparable)->isEqualTo = new boolean\false(),
				$this->testedInstance->add($comparable),
				$this->calling($comparable)->isEqualTo = new boolean\true()
			)
			->then
				->object($this->testedInstance->ifContains($comparable, function() use (& $contains) { $contains = true; }, function() use (& $contains) { $contains = false; }))->isTestedInstance
				->boolean($contains)->isTrue

			->if($this->calling($comparable)->isEqualTo = new boolean\false())
			->then
				->object($this->testedInstance->ifContains($comparable, function() use (& $contains) { $contains = true; }, function() use (& $contains) { $contains = false; }))->isTestedInstance
				->boolean($contains)->isFalse
		;
	}
}
