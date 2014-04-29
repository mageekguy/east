<?php

namespace jobs\tests\units\collections;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units,
	jobs\boolean,
	mock\jobs\world
;

class set extends units\test
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\collections\set');
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
				$this->calling($comparable1)->isEqualTo = function($comparable) use ($comparable1) { return new boolean($comparable1 == $comparable); },
				$this->calling($comparable2)->isEqualTo = function($comparable) use ($comparable2) { return new boolean($comparable2 == $comparable); },

				$this->testedInstance->add($comparable1)
			)
			->then
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isTrue
		;
	}

	public function testAdd()
	{
		$this
			->given(
				$this->newTestedInstance,
				$comparable1 = new world\comparable,
				$comparable2 = new world\comparable
			)

			->if(
				$this->calling($comparable1)->isEqualTo = function($comparable) use ($comparable1) { return new boolean($comparable1 == $comparable); },
				$this->calling($comparable2)->isEqualTo = function($comparable) use ($comparable2) { return new boolean($comparable2 == $comparable); }
			)
			->then
				->object($this->testedInstance->add($comparable1))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isTrue
				->boolean($this->testedInstance->hasSize(1))->isTrue

				->object($this->testedInstance->add($comparable2))->isTestedInstance
				->boolean($this->testedInstance->contains($comparable1))->isTrue
				->boolean($this->testedInstance->contains($comparable2))->isTrue
				->boolean($this->testedInstance->hasSize(1))->isTrue
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
				$this->calling($comparable1)->isEqualTo = function($comparable) use ($comparable1) { return new boolean($comparable1 == $comparable); },
				$this->calling($comparable2)->isEqualTo = function($comparable) use ($comparable2) { return new boolean($comparable2 == $comparable); },
				$this->testedInstance
					->add($comparable1)
					->add($comparable2)
			)
			->then
				->object($this->testedInstance->remove($comparable1))->isTestedInstance
				->boolean($this->testedInstance->isEmpty())->isTrue
		;
	}
}
