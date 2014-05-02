<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
	jobs\tests\units,
	mock\jobs\world
;

class complex extends units\test
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\complex');
	}

	public function testAddToComplex()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addToComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('addTo')->withArguments(0, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->addToComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('addTo')->withArguments($realPart, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), $imaginaryPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->addToComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('addTo')->withArguments($realPart, $imaginaryPart)->once
		;
	}

	public function testMultiplyWithComplex()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyWithComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('multiplyWith')->withArguments(0, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->multiplyWithComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('multiplyWith')->withArguments($realPart, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), $imaginaryPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->multiplyWithComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('multiplyWith')->withArguments($realPart, $imaginaryPart)->once
		;
	}

	public function testAddTo()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addTo(0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addTo(0, 0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addTo($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), 0))
					->isTestedInstance
					->isEqualTo($this->newInstance($realPart))

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addTo($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), $imaginaryPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
					->isTestedInstance
					->isEqualTo($this->newInstance($realPart, $imaginaryPart))

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->addTo(0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1))

			->given($this->newTestedInstance(1, 0))
			->then
				->object($this->testedInstance->addTo(0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1))

			->given($this->newTestedInstance(1, 1))
			->then
				->object($this->testedInstance->addTo(0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1, 1))

			->given($this->newTestedInstance(1, 1))
			->then
				->object($this->testedInstance->addTo(0, 0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1, 1))

			->given($this->newTestedInstance(1, 1))
			->then
				->object($this->testedInstance->addTo(1, 1))
					->isTestedInstance
					->isEqualTo($this->newInstance(2, 2))
		;
	}

	public function testMultiplyWith()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyWith(0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyWith(0, 0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyWith(rand(- PHP_INT_MAX, PHP_INT_MAX), 0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyWith(rand(- PHP_INT_MAX, PHP_INT_MAX), rand(- PHP_INT_MAX, PHP_INT_MAX)))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->multiplyWith($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
					->isTestedInstance

			->given($this->newTestedInstance(1))
				->object($this->testedInstance->multiplyWith($realPart = 2, $imaginaryPart = 3))
					->isTestedInstance
					->isEqualTo($this->newInstance(2, 3))

			->given($this->newTestedInstance(1, 1))
				->object($this->testedInstance->multiplyWith($realPart = 2, $imaginaryPart = 3))
					->isTestedInstance
					->isEqualTo($this->newInstance(-1, 5))

			->given($this->newTestedInstance(2, 2))
				->object($this->testedInstance->multiplyWith($realPart = 2, $imaginaryPart = 3))
					->isTestedInstance
					->isEqualTo($this->newInstance(-2, 10))
		;
	}
}
