<?php

namespace jobs\tests\units\collection;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units,
	jobs\boolean
;

class action extends units\test
{
	public function test__invoke()
	{
		$this
			->given($testedInstance = $this->newTestedInstance(function() {}))
			->then
				->boolean($testedInstance())->isFalse

			->given($testedInstance = $this->newTestedInstance(function() {}, $true = new boolean\true))
			->then
				->object($testedInstance())->isIdenticalTo($true)

			->given($testedInstance = $this->newTestedInstance(function() use (& $false) { return $false = new boolean\false; }))
			->then
				->object($testedInstance())->isIdenticalTo($false)

			->given($testedInstance = $this->newTestedInstance(function() use (& $true) { return $true = new boolean\true; }))
			->then
				->object($testedInstance())->isIdenticalTo($true)
		;
	}
}
