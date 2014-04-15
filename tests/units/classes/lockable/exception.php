<?php

namespace jobs\tests\units\lockable;

require __DIR__ . '/../../runner.php';

class exception extends \atoum
{
	public function testClass()
	{
		$this->testedClass
			->implements('jobs\exception')
			->extends('runtimeException')
		;
	}
}
