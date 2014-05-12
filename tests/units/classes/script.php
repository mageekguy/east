<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
	mock\jobs\world\configuration
;

class script extends test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\configurable');
	}

	function testReadConfiguration()
	{
		$this
			->given(
				$this->newTestedInstance,
				$configuration = new configuration
			)
			->then
				->object($this->testedInstance->readConfiguration($configuration))->isTestedInstance
				->mock($configuration)->call('configure')->withIdenticalArguments($this->testedInstance)->once
		;
	}
}
