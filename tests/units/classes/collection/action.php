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

			->given($testedInstance = $this->newTestedInstance(function() {}, new boolean\true))
			->then
				->boolean($testedInstance())->isTrue

			->given($testedInstance = $this->newTestedInstance(function() { return new boolean\false; }))
			->then
				->boolean($testedInstance())->isFalse

			->given($testedInstance = $this->newTestedInstance(function() { return new boolean\true; }))
			->then
				->boolean($testedInstance())->isTrue
		;
	}
}
