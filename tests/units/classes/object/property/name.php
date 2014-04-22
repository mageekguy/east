<?php

namespace jobs\tests\units\object\property;

require __DIR__ . '/../../../runner.php';

class name extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\object\property\name');
	}

	public function testMatch()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->match($this->testedInstance))->isTestedInstance
				->object($this->testedInstance->match(clone $this->testedInstance))->isTestedInstance
				->exception(function() { $this->testedInstance->match(new \mock\jobs\world\object\property\name()); })
					->isInstanceOf('jobs\object\property\name\exception')
					->hasMessage('Name does not match!')
		;
	}
}
