<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units,
	jobs\boolean,
	mock\jobs\world\comparable
;

class dictionary extends units\test
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\collections\dictionary');
	}

	public function testAdd()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new comparable(),
				$comparable2 = new comparable()
			)

			->if(
				$this->calling($comparable1)->isEqualTo = function($comparable) use ($comparable1) { return new boolean($comparable1 == $comparable); },
				$this->calling($comparable2)->isEqualTo = function($comparable) use ($comparable2) { return new boolean($comparable2 == $comparable); }
			)
			->then
				->object($this->testedInstance->add($comparable1, $comparable1Value = uniqid()))->isTestedInstance
				->boolean($this->testedInstance->containsAt($comparable1Value, $comparable1))->isTrue

				->object($this->testedInstance->add($comparable2, $comparable2Value = uniqid()))->isTestedInstance
				->boolean($this->testedInstance->containsAt($comparable2Value, $comparable1))->isTrue
				->boolean($this->testedInstance->containsAt($comparable2Value, $comparable2))->isTrue
		;
	}

	public function testRemove()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new comparable(),
				$comparable2 = new comparable()
			)
			->then
				->object($this->testedInstance->remove($comparable1))->isTestedInstance

			->if(
				$this->calling($comparable1)->isEqualTo = function($comparable) use ($comparable1) { return new boolean($comparable1 == $comparable); },
				$this->calling($comparable2)->isEqualTo = function($comparable) use ($comparable2) { return new boolean($comparable2 == $comparable); },
				$this->testedInstance
					->add($comparable1, uniqid())
					->add($comparable2, uniqid())
			)
			->then
				->object($this->testedInstance->remove($comparable1))->isTestedInstance
				->boolean($this->testedInstance->isEmpty())->isTrue

			->if(
				$this->calling($comparable1)->isEqualTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); },
				$this->calling($comparable2)->isEqualTo = function($comparable) use ($comparable2) { return new boolean($comparable2 === $comparable); },
				$this->testedInstance
					->add($comparable1, uniqid())
					->add($comparable2, $comparable2Value = uniqid())
			)
			->then
				->object($this->testedInstance->remove($comparable1))->isTestedInstance
				->boolean($this->testedInstance->hasSize(1))->isTrue
				->boolean($this->testedInstance->containsAt($comparable2Value, $comparable2))->isTrue
		;
	}

	public function testApply()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->apply($comparable = new comparable(), function() {}))->isFalse

			->if(
				$this->testedInstance->add($comparable, $value = uniqid()),
				$this->calling($comparable)->isEqualTo = new boolean\true()
			)
			->then
				->boolean($this->testedInstance->apply($comparable, function($value) use (& $innerValue) { $innerValue = $value; }))->isTrue
				->string($innerValue)->isEqualTo($value)
		;
	}

	public function testWalk()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->walk(function($value, $key) use (& $innerValue, & $innerKey) { $innerValue = $value; $innerKey = $key; }))->isTrue
				->variable($innerValue)->isNull
				->variable($innerKey)->isNull

			->if($this->testedInstance->add($comparable = new comparable(), $value = uniqid()))
			->then
				->boolean($this->testedInstance->walk(function($value, $key) use (& $innerValue, & $innerKey) { $innerValue = $value; $innerKey = $key; }))->isTrue
				->string($innerValue)->isEqualTo($value)
				->object($innerKey)->isIdenticalTo($comparable)
		;
	}
}
