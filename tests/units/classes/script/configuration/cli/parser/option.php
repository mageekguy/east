<?php

namespace jobs\tests\units\script\configuration\cli\parser;

require __DIR__ . '/../../../../../runner.php';

use
	jobs\tests\units,
	jobs\boolean
;

class option extends units\test
{
	function testAddArgument()
	{
		$this
			->given(
				$this->newTestedInstance(uniqid()),
				$argument1 = uniqid(),
				$argument2 = uniqid()
			)
			->then
				->object($this->testedInstance->addArgument($argument1))->isTestedInstance
				->boolean($this->testedInstance->hasArgument($argument1))->isTrue
				->boolean($this->testedInstance->hasArgument($argument2))->isFalse

				->object($this->testedInstance->addArgument($argument2 = uniqid()))->isTestedInstance
				->boolean($this->testedInstance->hasArgument($argument1))->isTrue
				->boolean($this->testedInstance->hasArgument($argument2))->isTrue
		;
	}

	function testExecute()
	{
		$this
			->given(
				$name = uniqid(),
				$argument1 = uniqid(),
				$argument2 = uniqid(),
				$this->newTestedInstance($name)
			)
			->then
				->boolean($this->testedInstance->execute(function($name, $arguments) use (& $optionName, & $optionArguments) { $optionName = $name; $optionArguments = $arguments; }))->isTrue
				->string($optionName)->isEqualTo($name)
				->array($optionArguments)->isEmpty

			->if($this->testedInstance
				->addArgument($argument1)
				->addArgument($argument2)
			)
			->then
				->boolean($this->testedInstance->execute(function($name, $arguments) use (& $optionName, & $optionArguments) { $optionName = $name; $optionArguments = $arguments; }))->isTrue
				->string($optionName)->isEqualTo($name)
				->array($optionArguments)->isEqualTo([ $argument1, $argument2 ])

				->boolean($this->testedInstance->execute(function($name, $arguments) use (& $optionName, & $optionArguments) { $optionName = $name; $optionArguments = $arguments; return new boolean\false; }))->isFalse
		;
	}
}
