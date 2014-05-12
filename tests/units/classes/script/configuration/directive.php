<?php

namespace jobs\tests\units\script\configuration;

require __DIR__ . '/../../../runner.php';

use
	jobs\tests\units,
	jobs\boolean,
	mock\jobs\world\configurable
;

class directive extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\configuration\directive');
	}

	function testExecute()
	{
		$this
			->given(
				$this->newTestedInstance($method = uniqid(), [ $arg1 = uniqid(), $arg2 = uniqid() ]),
				$configurable = new configurable
			)
			->then
				->object($this->testedInstance->execute($configurable))->isTestedInstance
				->mock($configurable)->call($method)->withIdenticalArguments($arg1, $arg2)->once
		;
	}
}
