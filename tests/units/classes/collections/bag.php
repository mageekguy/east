<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units,
	jobs\boolean,
	mock\jobs\world
;

class bag extends units\test
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
				$comparable1 = new world\comparable,
				$comparable2 = new world\comparable
			)

			->if($this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); })
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isTrue

			->if($this->calling($comparable2)->isIdenticalTo = function($comparable) use ($comparable2) { return new boolean($comparable2 === $comparable); })
			->then
				->object($this->testedInstance->add($comparable2))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isTrue
				->boolean($this->testedInstance->hasSize(2))->isTrue

				->object($this->testedInstance->add($comparable2))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isTrue
				->boolean($this->testedInstance->hasSize(2))->isTrue
		;
	}

	public function testRemove()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable,
				$comparable2 = new world\comparable
			)
			->then
				->object($this->testedInstance->remove($comparable1))->isTestedInstance

			->if(
					$this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); },
					$this->calling($comparable2)->isIdenticalTo = function($comparable) use ($comparable2) { return new boolean($comparable2 === $comparable); },
					$this->testedInstance
						->add($comparable1)
						->add($comparable2)
				)
			->then
				->object($this->testedInstance->remove($comparable2))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isFalse

				->object($this->testedInstance->remove($comparable1))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isFalse
				->boolean($this->testedInstance->contains($comparable2))->isFalse
		;
	}

	public function testRemoveAt()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable(),
				$comparable2 = new world\comparable()
			)
			->then
				->object($this->testedInstance->removeAt(rand(- PHP_INT_MAX, PHP_INT_MAX)))->isTestedInstance

			->if(
				$this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); },
				$this->calling($comparable2)->isIdenticalTo = function($comparable) use ($comparable2) { return new boolean($comparable2 === $comparable); },

				$this->testedInstance
					->add($comparable1)
					->add($comparable2)
			)
			->then
				->object($this->testedInstance->removeAt(0))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isFalse
				->boolean($this->testedInstance->contains($comparable2))->isTrue

				->object($this->testedInstance->removeAt(1))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isFalse
				->boolean($this->testedInstance->contains($comparable2))->isFalse
		;
	}

	public function testRemoveLast()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable(),
				$comparable2 = new world\comparable()
			)
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance

			->if(
				$this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); },
				$this->calling($comparable2)->isIdenticalTo = function($comparable) use ($comparable2) { return new boolean($comparable2 === $comparable); },

				$this->testedInstance
					->add($comparable1)
					->add($comparable2)
			)
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isFalse

				->object($this->testedInstance->removeLast())->isTestedInstance
				->boolean($this->testedInstance->isEmpty())->isTrue
		;
	}

	public function testRemoveAll()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable(),
				$comparable2 = new world\comparable()
			)
			->then
				->object($this->testedInstance->removeAll())->isTestedInstance

			->if(
				$this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); },
				$this->calling($comparable2)->isIdenticalTo = function($comparable) use ($comparable2) { return new boolean($comparable2 === $comparable); },

				$this->testedInstance
					->add($comparable1)
					->add($comparable2)
			)
			->then
				->object($this->testedInstance->removeAll())->isTestedInstance
				->boolean($this->testedInstance->isEmpty())->isTrue
		;
	}

	public function testApply()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable()
			)
			->then
				->boolean($this->testedInstance->apply(rand(- PHP_INT_MAX, PHP_INT_MAX), function() {}))->isFalse

			->if(
				$this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); },
				$this->testedInstance->add($comparable1)
			)
			->then
				->boolean($this->testedInstance->apply(0, function($value) use (& $innerValue) { $innerValue = $value; }))->isTrue
				->object($innerValue)->isIdenticalTo($comparable1)
		;
	}

	public function testApplyOn()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable()
			)

			->if($this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); })
			->then
				->boolean($this->testedInstance->applyOn($comparable1, function() {}))->isFalse

			->if($this->testedInstance->add($comparable1))
			->then
				->boolean($this->testedInstance->applyOn($comparable1, function($comparable, $key) use (& $innerComparable, & $innerKey) { $innerComparable = $comparable; $innerKey = $key; }))->isTrue
				->object($innerComparable)->isIdenticalTo($comparable1)
				->integer($innerKey)->isZero

				->boolean($this->testedInstance->applyOn($comparable1, function($comparable, $key) use (& $otherInnerComparable, & $otherInnerKey) { $otherInnerComparable = $comparable; $otherInnerKey = $key; return new boolean\false; }))->isFalse
				->object($otherInnerComparable)->isIdenticalTo($comparable1)
				->integer($otherInnerKey)->isZero
		;
	}

	public function testContains()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable(),
				$comparable2 = new world\comparable()
			)
			->then
				->boolean($this->testedInstance->contains($comparable1))->isFalse

			->if(
				$this->calling($comparable1)->isIdenticalTo = function($comparable) use ($comparable1) { return new boolean($comparable1 === $comparable); },
				$this->calling($comparable2)->isIdenticalTo = function($comparable) use ($comparable2) { return new boolean($comparable2 === $comparable); },

				$this->testedInstance->add($comparable1)
			)
			->then
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isFalse
		;
	}
}
