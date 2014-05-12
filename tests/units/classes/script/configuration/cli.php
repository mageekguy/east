<?php

namespace jobs\tests\units\script\configuration;

require __DIR__ . '/../../../runner.php';

use
	jobs\tests\units,
	mock\jobs\world\configurable,
	mock\jobs\world\configuration\cli\parser
;

class cli extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\configuration');
	}

	function test__construct()
	{
		$this
			->given(
				$this->newTestedInstance($values = [], $parser = new parser)
			)
			->then
				->mock($parser)->call('parse')->withIdenticalArguments($values, $this->testedInstance)->once
		;
	}
}
