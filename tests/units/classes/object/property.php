<?php

namespace jobs\tests\units\object;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world\object,
	mock\jobs\world\object\property\name,
	mock\jobs\world\object\property\value
;

class property extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\object\property');
	}
}
