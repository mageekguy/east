<?php

namespace jobs\tests\units\script\configuration\cli\parser;

require __DIR__ . '/../../../../../runner.php';

use
	jobs\tests\units,
	mock\jobs\world\cli\parser
;

class arguments extends units\test
{
	function testAdd()
	{
		$this
			->given(
				$this->newTestedInstance,
				$argument = new parser\argument
			)
			->then
				->object($this->testedInstance->addOption($argument))->isTestedInstance
		;
	}
}
