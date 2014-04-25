<?php

namespace jobs\tests\units\object;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world,
	mock\jobs\world\object\property\name,
	mock\jobs\world\object\property\value
;

class property extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\object\property');
	}

	public function testLinkTo()
	{
		$this
			->given(
				$this->newTestedInstance($name = new name(), $value = new value()),
				$object = new world\object(),
				$area = new world\area()
			)
			->then
				->object($this->testedInstance->linkTo($object, $area))->isTestedInstance
		;
	}
}
