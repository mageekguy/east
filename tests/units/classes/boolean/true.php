<?php

namespace jobs\tests\units\boolean;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units,
	jobs\boolean
;

class true extends units\test
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\boolean');
	}

	public function testIfTrue()
	{
		$this
			->object($this->newTestedInstance->ifTrue(function() use (& $callable1) { $callable1 = true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable1)->isNotNull

			->object($this->newTestedInstance->ifTrue(function() use (& $callable2) { $callable2 = true; return false; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable2)->isNotNull

			->object($this->newTestedInstance->ifTrue(function() use (& $callable3) { $callable3 = true; return true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable3)->isNotNull

			->object($this->newTestedInstance->ifTrue(function() use (& $callable4) { $callable4 = true; return new boolean\false; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable4)->isNotNull

			->object($this->newTestedInstance->ifTrue(function() use (& $callable5) { $callable5 = true; return new boolean\true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable5)->isNotNull
		;
	}

	public function testIfFalse()
	{
		$this
			->object($this->newTestedInstance->ifFalse(function() use (& $callable) { $callable = true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable)->isNull

			->object($this->newTestedInstance->ifFalse(function() use (& $callable) { $callable = true; return true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable)->isNull

			->object($this->newTestedInstance->ifFalse(function() use (& $callable)  { $callable = true; return false; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable)->isNull

			->object($this->newTestedInstance->ifFalse(function() use (& $callable) { $callable = true; return new boolean\false; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable)->isNull

			->object($this->newTestedInstance->ifFalse(function() use (& $callable) { $callable = true; return new boolean\true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable)->isNull
		;

	}
}
