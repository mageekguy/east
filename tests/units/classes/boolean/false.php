<?php

namespace jobs\tests\units\boolean;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean
;

class false extends \atoum
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
				->variable($isTrue)->isNull
		;
	}

	public function testIfFalse()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->ifFalse(function() use (& $isFalse) { $isFalse = true; }))->isTestedInstance
				->boolean($isFalse)->isTrue

				->object($this->testedInstance->ifFalse(function() use (& $isFalseAgain) { $isFalseAgain = true; return true; }))->isEqualTo(new boolean\true())
				->boolean($isFalseAgain)->isTrue
		;
	}
}
