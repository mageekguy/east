<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean,
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

			->if($this->calling($comparable1)->isIdenticalTo = new boolean\false())
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->isIdenticalTo = new boolean\true())
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

			->if($this->calling($comparable1)->isIdenticalTo = new boolean\false())
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
				$this->calling($comparable)->isIdenticalTo = new boolean\false(),
				$this->testedInstance->add($comparable),
				$this->calling($comparable)->isIdenticalTo = new boolean\true()
			)
			->then
				->object($this->testedInstance->remove($comparable))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->calling($comparable)->isIdenticalTo = new boolean\false(),
				$this->testedInstance->add($comparable),
				$this->calling($comparable)->isIdenticalTo = new boolean\true()
			)
			->then
				->object($this->testedInstance->remove($comparable, function($comparable) use (& $removedComparable) { $removedComparable = $comparable; }))->isTestedInstance
				->sizeof($this->testedInstance)->isZero
				->object($removedComparable)->isIdenticalTo($comparable)
		;
	}

	public function testRemoveAt()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->removeAt(rand(- PHP_INT_MAX, PHP_INT_MAX)))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$comparable0 = new world\comparable(),
				$this->calling($comparable0)->isIdenticalTo = new boolean\false(),

				$comparable1 = new world\comparable(),
				$this->calling($comparable1)->isIdenticalTo = new boolean\false(),

				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
			)
			->then
				->object($this->testedInstance->removeAt(0))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

				->object($this->testedInstance->removeAt(1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

				->object($this->testedInstance->removeAt(0))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
			)
			->then
				->object($this->testedInstance->removeAt(1))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

				->object($this->testedInstance->removeAt(0))->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
			)
			->then
				->object($this->testedInstance->removeAt(0, function($comparable) use (& $removedComparable0) { $removedComparable0 = $comparable; }))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)
				->object($removedComparable0)->isIdenticalTo($comparable0)

				->object($this->testedInstance->removeAt(1, function($comparable) use (& $removedComparable1) { $removedComparable1 = $comparable; }))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)
				->variable($removedComparable1)->isNull

				->object($this->testedInstance->removeAt(0, function($comparable) use (& $removedComparable0) { $removedComparable0 = $comparable; }))->isTestedInstance
				->sizeof($this->testedInstance)->isZero
				->object($removedComparable0)->isIdenticalTo($comparable1)
		;
	}

	public function testRemoveLast()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$comparable0 = new world\comparable(),
				$this->calling($comparable0)->isIdenticalTo = new boolean\false(),

				$comparable1 = new world\comparable(),
				$this->calling($comparable1)->isIdenticalTo = new boolean\false(),

				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
			)
			->then
				->object($this->testedInstance->removeLast())->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)

				->object($this->testedInstance->removeLast())->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
			)
			->then
				->object($this->testedInstance->removeLast(function($comparable) use (& $removedComparable) { $removedComparable = $comparable; }))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)
				->object($removedComparable)->isEqualTo($comparable1)

				->object($this->testedInstance->removeLast(function($comparable) use (& $removedComparable) { $removedComparable = $comparable; }))->isTestedInstance
				->sizeof($this->testedInstance)->isZero
				->object($removedComparable)->isEqualTo($comparable0)

			->if(
				$comparable2 = new world\comparable(),
				$this->calling($comparable2)->isIdenticalTo = new boolean\false(),
				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
					->add($comparable2)
			)
			->then
				->object($this->testedInstance->removeLast(function($comparable) use (& $removedComparables) { $removedComparables[] = $comparable; }, 2))->isTestedInstance
				->sizeof($this->testedInstance)->isEqualTo(1)
				->array($removedComparables)->isEqualTo([ $comparable2, $comparable1 ])
		;
	}

	public function testRemoveAll()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->removeAll())->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$comparable0 = new world\comparable(),
				$this->calling($comparable0)->isIdenticalTo = new boolean\false(),

				$comparable1 = new world\comparable(),
				$this->calling($comparable1)->isIdenticalTo = new boolean\false(),

				$comparable2 = new world\comparable(),
				$this->calling($comparable2)->isIdenticalTo = new boolean\false(),

				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
					->add($comparable2)
			)
			->then
				->object($this->testedInstance->removeAll())->isTestedInstance
				->sizeof($this->testedInstance)->isZero

			->if(
				$this->testedInstance
					->add($comparable0)
					->add($comparable1)
					->add($comparable2)
			)
			->then
				->object($this->testedInstance->removeAll(function($comparable) use (& $removedComparables) { $removedComparables[] = $comparable; }))->isTestedInstance
				->sizeof($this->testedInstance)->isZero
				->array($removedComparables)->isEqualTo([ $comparable0, $comparable1, $comparable2 ])
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
				$this->calling($comparable)->isIdenticalTo = new boolean\false(),
				$this->testedInstance->add($comparable),
				$this->calling($comparable)->isIdenticalTo = new boolean\true()
			)
			->then
				->object($this->testedInstance->ifContains($comparable, function() use (& $contains) { $contains = true; }, function() use (& $contains) { $contains = false; }))->isTestedInstance
				->boolean($contains)->isTrue

			->if($this->calling($comparable)->isIdenticalTo = new boolean\false())
			->then
				->object($this->testedInstance->ifContains($comparable, function() use (& $contains) { $contains = true; }, function() use (& $contains) { $contains = false; }))->isTestedInstance
				->boolean($contains)->isFalse
		;
	}
}
