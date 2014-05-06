<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean,
	mock\jobs\world,
	mock\jobs\world\objects
;

class key extends \atoum
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
				->object($this->testedInstance->isEqualTo($key))->isEqualTo(new boolean\false())
				->object($this->testedInstance->isEqualTo($this->testedInstance))->isEqualTo(new boolean\true())
				->object($this->testedInstance->isEqualTo(clone $this->testedInstance))->isEqualTo(new boolean\true())
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
				->object($this->testedInstance->isIdenticalTo($key))->isEqualTo(new boolean\false())
				->object($this->testedInstance->isIdenticalTo($this->testedInstance))->isEqualTo(new boolean\true())
				->object($this->testedInstance->isIdenticalTo(clone $this->testedInstance))->isEqualTo(new boolean\false())
		;
	}
}
