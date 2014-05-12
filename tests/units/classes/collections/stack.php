<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units
;

class stack extends units\test
{
	function testPush()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->push($value1 = uniqid()))->isTestedInstance
				->boolean($this->testedInstance->contains($value1))->isTrue

				->object($this->testedInstance->push($value2 = uniqid()))->isTestedInstance
				->boolean($this->testedInstance->contains($value1))->isTrue
				->boolean($this->testedInstance->contains($value2))->isTrue
		;
	}

	function testPop()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->pop())->isTestedInstance

			->if(
				$this->testedInstance->push($value1 = uniqid()),
				$this->testedInstance->push($value2 = uniqid())
			)
			->then
				->object($this->testedInstance->pop())->isTestedInstance
				->boolean($this->testedInstance->contains($value2))->isFalse

				->object($this->testedInstance->pop())->isTestedInstance
				->boolean($this->testedInstance->contains($value2))->isFalse
				->boolean($this->testedInstance->contains($value1))->isFalse
		;
	}

	function testApply()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->apply(function() {}))->isFalse

			->if(
				$this->testedInstance->push($value1 = uniqid()),
				$this->testedInstance->push($value2 = uniqid())
			)
			->then
				->boolean($this->testedInstance->apply(function($stackValue) use (& $value) { $value = $stackValue; }))->isTrue
				->string($value)->isEqualTo($value2)


			->if($this->testedInstance->pop())
			->then
				->boolean($this->testedInstance->apply(function($stackValue) use (& $value) { $value = $stackValue; }))->isTrue
				->string($value)->isEqualTo($value1)
		;
	}

	function testWalk()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->walk(function() {}))->isTrue

			->if(
				$this->testedInstance->push($value1 = uniqid()),
				$this->testedInstance->push($value2 = uniqid())
			)
			->then
				->boolean($this->testedInstance->walk(function($stackValue) use (& $values) { $values[] = $stackValue; }))->isTrue
				->array($values)->isEqualTo([ $value2, $value1 ])
		;
	}

	function testReverse()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->reverse())->isEqualTo($this->newInstance)

			->if(
				$this->testedInstance->push($value1 = uniqid()),
				$this->testedInstance->push($value2 = uniqid())
			)
			->then
				->boolean($this->testedInstance->reverse())->isEqualTo($this->newInstance->push($value2)->push($value1))
		;
	}
}
