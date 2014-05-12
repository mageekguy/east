<?php

namespace jobs\tests\units\script;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units,
	jobs\script,
	mock\jobs\world\configurable,
	mock\jobs\world\configuration\directive
;

class configuration extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\configuration');
	}

	function testConfigure()
	{
		$this
			->given(
				$directive1 = new directive,
				$directive2 = new directive,
				$configurable = new configurable,
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->configure($configurable))->isTestedInstance

			->if($this->testedInstance->addDirective($directive1))
			->then
				->object($this->testedInstance->configure($configurable))->isTestedInstance
				->mock($directive1)->call('execute')->withIdenticalArguments($configurable)->once

			->if($this->testedInstance->addDirective($directive2))
			->then
				->object($this->testedInstance->configure($configurable))->isTestedInstance
				->mock($directive1)->call('execute')->withIdenticalArguments($configurable)->twice
				->mock($directive2)->call('execute')->withIdenticalArguments($configurable)->once
		;
	}

	function testAddDirective()
	{
		$this
			->given(
				$directive1 = new directive,
				$directive2 = new directive,
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->addDirective($directive1))->isTestedInstance
				->boolean($this->testedInstance->containsDirective($directive1))->isTrue

				->object($this->testedInstance->addDirective($directive2))->isTestedInstance
				->boolean($this->testedInstance->containsDirective($directive1))->isTrue
				->boolean($this->testedInstance->containsDirective($directive2))->isTrue
		;
	}
}
