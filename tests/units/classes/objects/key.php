<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	jobs\tests\units,
	jobs\boolean,
	mock\jobs\world\area,
	mock\jobs\world\objects
;

class key extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\objects\key');
	}

	function testIsEqualTo()
	{
		$this
			->given(
				$this->newTestedInstance,
				$key = new objects\key()
			)
			->then
				->boolean($this->testedInstance->isEqualTo($key))->isFalse
				->boolean($this->testedInstance->isEqualTo($this->testedInstance))->isTrue
				->boolean($this->testedInstance->isEqualTo(clone $this->testedInstance))->isTrue
		;
	}

	function testIsIdenticalTo()
	{
		$this
			->given(
				$this->newTestedInstance,
				$key = new objects\key()
			)
			->then
				->boolean($this->testedInstance->isIdenticalTo($key))->isFalse
				->boolean($this->testedInstance->isIdenticalTo($this->testedInstance))->isTrue
				->boolean($this->testedInstance->isIdenticalTo(clone $this->testedInstance))->isFalse
		;
	}

	function testEnterInArea()
	{
		$this
			->given(
				$this->newTestedInstance,
				$area = new area
			)
			->then
				->object($this->testedInstance->enterInArea($area))->isTestedInstance
				->mock($area)->call('objectEnter')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	function testLeaveArea()
	{
		$this
			->given(
				$this->newTestedInstance,
				$area = new area
			)
			->then
				->object($this->testedInstance->leaveArea($area))->isTestedInstance
				->mock($area)->call('objectLeave')->withIdenticalArguments($this->testedInstance)->once
		;
	}
}
