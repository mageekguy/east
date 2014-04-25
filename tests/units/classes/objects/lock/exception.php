<?php

namespace jobs\tests\units\objects\lock;

require __DIR__ . '/../../../runner.php';

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
