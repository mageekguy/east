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

	public function testAddComplex()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('addToComplex')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	public function testAddToComplex()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addToComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('add')->withArguments(0, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->addToComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('add')->withArguments($realPart, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), $imaginaryPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->addToComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('add')->withArguments($realPart, $imaginaryPart)->once
		;
	}

	public function testAdd()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add(0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add(0, 0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), 0))
					->isTestedInstance
					->isEqualTo($this->newInstance($realPart))

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), $imaginaryPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
					->isTestedInstance
					->isEqualTo($this->newInstance($realPart, $imaginaryPart))

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->add(0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1))

			->given($this->newTestedInstance(1, 0))
			->then
				->object($this->testedInstance->add(0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1))

			->given($this->newTestedInstance(1, 1))
			->then
				->object($this->testedInstance->add(0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1, 1))

			->given($this->newTestedInstance(1, 1))
			->then
				->object($this->testedInstance->add(0, 0))
					->isTestedInstance
					->isEqualTo($this->newInstance(1, 1))

			->given($this->newTestedInstance(1, 1))
			->then
				->object($this->testedInstance->add(1, 1))
					->isTestedInstance
					->isEqualTo($this->newInstance(2, 2))
		;
	}

	public function testMultiplyWithComplex()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyWithComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('multiplyComplex')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	public function testMultiplyComplex()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('multiply')->withArguments(0, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->multiplyComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('multiply')->withArguments($realPart, 0)->once

			->given($this->newTestedInstance($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX), $imaginaryPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->multiplyComplex($complex = new world\complex))->isTestedInstance
				->mock($complex)
					->call('multiply')->withArguments($realPart, $imaginaryPart)->once
		;
	}

	public function testMultiply()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiply(0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiply(0, 0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiply(rand(- PHP_INT_MAX, PHP_INT_MAX), 0))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiply(rand(- PHP_INT_MAX, PHP_INT_MAX), rand(- PHP_INT_MAX, PHP_INT_MAX)))
					->isTestedInstance
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->multiply($realPart = rand(- PHP_INT_MAX, PHP_INT_MAX)))
					->isTestedInstance

			->given($this->newTestedInstance(1))
				->object($this->testedInstance->multiply($realPart = 2, $imaginaryPart = 3))
					->isTestedInstance
					->isEqualTo($this->newInstance(2, 3))

			->given($this->newTestedInstance(1, 1))
				->object($this->testedInstance->multiply($realPart = 2, $imaginaryPart = 3))
					->isTestedInstance
					->isEqualTo($this->newInstance(-1, 5))

			->given($this->newTestedInstance(2, 2))
				->object($this->testedInstance->multiply($realPart = 2, $imaginaryPart = 3))
					->isTestedInstance
					->isEqualTo($this->newInstance(-2, 10))
		;
	}

	public function testHasModuleGreaterThan()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->boolean($this->testedInstance->hasModuleGreaterThan(0))->isFalse

			->given($this->newTestedInstance(1))
			->then
				->boolean($this->testedInstance->hasModuleGreaterThan(0))->isTrue
				->boolean($this->testedInstance->hasModuleGreaterThan(1))->isFalse

			->given($this->newTestedInstance(2))
			->then
				->boolean($this->testedInstance->hasModuleGreaterThan(0))->isTrue
				->boolean($this->testedInstance->hasModuleGreaterThan(1))->isTrue
				->boolean($this->testedInstance->hasModuleGreaterThan(2))->isFalse

			->given($this->newTestedInstance(2, 2))
			->then
				->boolean($this->testedInstance->hasModuleGreaterThan(0))->isTrue
				->boolean($this->testedInstance->hasModuleGreaterThan(1))->isTrue
				->boolean($this->testedInstance->hasModuleGreaterThan(2))->isTrue
				->boolean($this->testedInstance->hasModuleGreaterThan(sqrt(8)))->isFalse
		;
	}
}
