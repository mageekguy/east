<?php

namespace jobs\tests\units\script\configuration;

require __DIR__ . '/../../../runner.php';

use
	jobs\tests\units,
	mock\jobs\world\configurable,
	mock\jobs\world\configuration
;

class directives extends units\test
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\configuration\directives');
	}

	public function testAddDirective()
	{
		$this
			->given(
				$this->newTestedInstance,
				$directive = new configuration\directive
			)

			->then
				->object($this->testedInstance->addDirective($directive))->isTestedInstance
				->boolean($this->testedInstance->containsDirective($directive))->isTrue
		;
	}

	public function testExecute()
	{
		$this
			->given(
				$this->newTestedInstance,
				$directive1 = new configuration\directive,
				$directive2 = new configuration\directive,
				$configurable = new configurable
			)

			->if($this->testedInstance
				->addDirective($directive1)
				->addDirective($directive2)
			)
			->then
				->object($this->testedInstance->execute($configurable))->isTestedInstance
				->mock($directive1)->call('execute')->withIdenticalArguments($configurable)->once
				->mock($directive2)->call('execute')->withIdenticalArguments($configurable)->once
		;
	}
}
