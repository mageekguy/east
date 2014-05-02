<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
	jobs\tests\units,
	jobs
;

class boolean extends units\test
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\boolean');
	}

	public function test__construct()
	{
		$this
			->given($this->newTestedInstance(true))
			->then
				->boolean($this->testedInstance)->isTrue

			->given($this->newTestedInstance(false))
			->then
				->boolean($this->testedInstance)->isFalse

			->given($boolean = new \mock\jobs\world\boolean())

			->if(
				$this->calling($boolean)->ifTrue->isFluent,
				$this->calling($boolean)->ifFalse = function($callable) use ($boolean) { $callable(); return $boolean; }
			)
			->then
				->boolean($this->newTestedInstance($boolean))->isFalse

			->if(
				$this->calling($boolean)->ifFalse->isFluent,
				$this->calling($boolean)->ifTrue = function($callable) use ($boolean) { $callable(); return $boolean; }
			)
			->then
				->boolean($this->newTestedInstance($boolean))->isTrue
		;
	}

	public function testIfTrue()
	{
		$this
			->object($this->newTestedInstance(false)->ifTrue(function() use (& $callable1) { $callable1 = true; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable1)->isNull

			->object($this->newTestedInstance(false)->ifTrue(function() use (& $callable2) { $callable2 = true; return true; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable2)->isNull

			->object($this->newTestedInstance(false)->ifTrue(function() use (& $callable3)  { $callable3 = true; return false; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable3)->isNull

			->object($this->newTestedInstance(false)->ifTrue(function() use (& $callable4) { $callable4 = true; return new \mock\jobs\world\boolean; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable4)->isNull

			->object($this->newTestedInstance(false)->ifTrue(function() use (& $callable5) { $callable5 = true; return new \mock\jobs\world\boolean; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable5)->isNull

			->object($this->newTestedInstance(true)->ifTrue(function() use (& $callable6) { $callable6 = true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable6)->isNotNull

			->object($this->newTestedInstance(true)->ifTrue(function() use (& $callable7) { $callable7 = true; return true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable7)->isNotNull

			->object($this->newTestedInstance(true)->ifTrue(function() use (& $callable8)  { $callable8 = true; return false; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable8)->isNotNull

			->given($boolean = new \mock\jobs\world\boolean())

			->if(
				$this->calling($boolean)->ifTrue->isFluent,
				$this->calling($boolean)->ifFalse = function($callable) use ($boolean) { $callable(); return $boolean; }
			)
			->then
				->object($this->newTestedInstance(true)->ifTrue(function() use (& $callable9, $boolean) { $callable9 = true; return $boolean; }))->isTestedInstance
				->boolean($this->testedInstance)->isFalse
				->variable($callable9)->isNotNull

			->if(
				$this->calling($boolean)->ifFalse->isFluent,
				$this->calling($boolean)->ifTrue = function($callable) use ($boolean) { $callable(); return $boolean; }
			)
			->then
				->object($this->newTestedInstance(true)->ifTrue(function() use (& $callable10, $boolean) { $callable10 = true; return $boolean; }))->isTestedInstance
				->boolean($this->testedInstance)->isTrue
				->variable($callable10)->isNotNull
		;
	}

	public function testIfFalse()
	{
		$this
			->object($this->newTestedInstance(true)->ifFalse(function() use (& $callable1) { $callable1 = true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable1)->isNull

			->object($this->newTestedInstance(true)->ifFalse(function() use (& $callable2) { $callable2 = true; return true; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable2)->isNull

			->object($this->newTestedInstance(true)->ifFalse(function() use (& $callable3) { $callable3 = true; return false; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable3)->isNull

			->object($this->newTestedInstance(true)->ifFalse(function() use (& $callable4) { $callable4 = true; return new \mock\jobs\world\boolean; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable4)->isNull

			->object($this->newTestedInstance(true)->ifFalse(function() use (& $callable5) { $callable5 = true; return new \mock\jobs\world\boolean; }))->isTestedInstance
			->boolean($this->testedInstance)->isTrue
			->variable($callable5)->isNull

			->object($this->newTestedInstance(false)->ifFalse(function() use (& $callable6) { $callable6 = true; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable6)->isNotNull

			->object($this->newTestedInstance(false)->ifFalse(function() use (& $callable7) { $callable7 = true; return true; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable7)->isNotNull

			->object($this->newTestedInstance(false)->ifFalse(function() use (& $callable8) { $callable8 = true; return false; }))->isTestedInstance
			->boolean($this->testedInstance)->isFalse
			->variable($callable8)->isNotNull

			->given($boolean = new \mock\jobs\world\boolean())

			->if(
				$this->calling($boolean)->ifTrue->isFluent,
				$this->calling($boolean)->ifFalse = function($callable) use ($boolean) { $callable(); return $boolean; }
			)
			->then
				->object($this->newTestedInstance(false)->ifFalse(function() use (& $callable9, $boolean) { $callable9 = true; return $boolean; }))->isTestedInstance
				->boolean($this->testedInstance)->isFalse
				->variable($callable9)->isNotNull

			->if(
				$this->calling($boolean)->ifFalse->isFluent,
				$this->calling($boolean)->ifTrue = function($callable) use ($boolean) { $callable(); return $boolean; }
			)
			->then
				->object($this->newTestedInstance(false)->ifFalse(function() use (& $callable10, $boolean) { $callable10 = true; return $boolean; }))->isTestedInstance
				->boolean($this->testedInstance)->isTrue
				->variable($callable10)->isNotNull
		;
	}
}
