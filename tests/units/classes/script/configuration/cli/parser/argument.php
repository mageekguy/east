<?php

namespace jobs\tests\units\script\configuration\cli\parser;

require __DIR__ . '/../../../../../runner.php';

use
	jobs\tests\units,
	mock\jobs\world\cli\parser\arguments
;

class argument extends units\test
{
	function testAddIn()
	{
		$this
			->given(
				$this->newTestedInstance($value = uniqid()),
				$arguments = new arguments
			)
			->then
				->object($this->testedInstance->addIn($arguments))->isTestedInstance
				->mock($arguments)->call('addArgument')->withIdenticalArguments($value)->once
		;
	}
}
