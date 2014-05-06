<?php

namespace jobs\tests\units\object\property\name;

require __DIR__ . '/../../../../runner.php';

class exception extends \atoum
{
	function testClass()
	{
		$this->testedClass
			->implements('jobs\exception')
			->extends('runtimeException')
		;
	}
}
