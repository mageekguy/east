<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
	jobs,
	jobs\tests\units,
	mock\jobs\world
;

class real extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\real');
	}

	function testAddValue()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->addValue($value = rand(-PHP_INT_MAX, PHP_INT_MAX)))->isEqualTo($this->newInstance($value))

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->addValue(1))->isEqualTo($this->newInstance(2))

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->addValue(-1))->isEqualTo($this->newInstance)

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->addValue(-2))->isEqualTo($this->newInstance(-1))

			->given(
				$this->newTestedInstance,
				$real = new world\real,
				$this->calling($real)->add = $result = new world\real
			)
			->then
				->object($this->testedInstance->addValue($real))->isIdenticalTo($result)
		;
	}

	function testAdd()
	{
		$this
			->given(
				$real = new world\real,
				$this->calling($real)->addRealAndImaginary = $result = new real
			)

			->if($this->newTestedInstance)
			->then
				->object($this->testedInstance->add($real))->isIdenticalTo($result)
				->mock($real)->call('addRealAndImaginary')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	function testSubstract()
	{
		$this
			->given(
				$real = new world\real,
				$this->calling($real)->opposite = $opposite = new world\real,
				$this->calling($opposite)->add = $result = new world\real
			)

			->if($this->newTestedInstance)
			->then
				->object($this->testedInstance->substract($real))->isIdenticalTo($result)
				->mock($opposite)->call('add')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	function testMultiplyWithValue()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiplyWithValue(1.))
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance(1.))
			->then
				->object($this->testedInstance->multiplyWithValue(1.))
					->isEqualTo($this->newInstance(1.))

			->given($this->newTestedInstance(2.))
			->then
				->object($this->testedInstance->multiplyWithValue(1.))
					->isEqualTo($this->newInstance(2.))

			->given($this->newTestedInstance(2.))
			->then
				->object($this->testedInstance->multiplyWithValue(2.))
					->isEqualTo($this->newInstance(4.))

			->given(
				$this->newTestedInstance,
				$real = new world\real,
				$this->calling($real)->multiply = $result = new world\real
			)
			->then
				->object($this->testedInstance->multiplyWithValue($real))->isIdenticalTo($result)
		;
	}

	function testMultiply()
	{
		$this
			->given(
				$this->newTestedInstance,
				$real = new world\real
			)

			->if($this->calling($real)->multiplyWithRealAndImaginary = $result = new world\real)
			->then
				->object($this->testedInstance->multiply($real))->isIdenticalTo($result)
				->mock($real)->call('multiplyWithRealAndImaginary')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	function testDivide()
	{
		$this
			->given(
				$this->newTestedInstance,
				$real = new world\real,
				$this->calling($real)->inverse = $inverse = new world\real,
				$this->calling($inverse)->multiply = $result = new world\real
			)

			->then
				->object($this->testedInstance->divide($real))->isIdenticalTo($result)
				->mock($inverse)->call('multiply')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	function testOpposite()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->opposite())
					->isNotIdenticalTo($this->testedInstance)
					->isEqualTo($this->newInstance)

			->given($this->newTestedInstance(- ($value = rand(1, PHP_INT_MAX))))
			->then
				->object($this->testedInstance->opposite())
					->isEqualTo($this->newInstance($value))

			->given($this->newTestedInstance($value))
			->then
				->object($this->testedInstance->opposite())
					->isEqualTo($this->newInstance(- $value))
		;
	}

	function testInverse()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->exception(function() { $this->testedInstance->inverse(); })
					->isInstanceOf('runtimeException')
					->hasMessage('Division by zero!')

			->given($this->newTestedInstance(1))
			->then
				->object($this->testedInstance->inverse())
					->isEqualTo($this->newInstance(1))

			->given($this->newTestedInstance($value = rand(- PHP_INT_MAX, -1)))
			->then
				->object($this->testedInstance->inverse())
					->isEqualTo($this->newInstance(1 / $value))

			->given($this->newTestedInstance($value = rand(1, PHP_INT_MAX)))
			->then
				->object($this->testedInstance->inverse())
					->isEqualTo($this->newInstance(1 / $value))
		;
	}
}
