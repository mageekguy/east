<?php

namespace jobs\tests\units\boolean;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean
;

class true extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\boolean');
	}

	public function testIfTrue()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->ifTrue(function() use (& $isTrue) { $isTrue = true; }))->isTestedInstance
				->boolean($isTrue)->isTrue

				->object($this->testedInstance->ifTrue(function() use (& $isTrueAgain) { $isTrueAgain = true; return false; }))->isEqualTo(new boolean\false())
				->boolean($isTrueAgain)->isTrue
		;
	}

	public function testIfFalse()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->ifFalse(function() use (& $isFalse) { $isFalse = true; }))->isTestedInstance
				->variable($isFalse)->isNull
		;
	}
}
