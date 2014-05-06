<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

use
	jobs\tests\units,
	jobs\real,
	mock\jobs\world
;

class complex extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\complex');
	}

	function testAddRealAndImaginary()
	{
		$this
			->given(
				$this->newTestedInstance($a = new world\real, $b = new world\real),
				$c = new world\real,
				$newRealPart = new world\real,
				$this->calling($c)->add = function($real) use ($a, $newRealPart) {
					switch (true)
					{
						case $real === $a:
							return $newRealPart;
					}
				},
				$d = new world\real,
				$newImaginaryPart = new world\real,
				$this->calling($d)->add = function($real) use ($b, $newImaginaryPart) {
					switch (true)
					{
						case $real === $b:
							return $newImaginaryPart;
					}
				}
			)
			->then
				->object($this->testedInstance->addRealAndImaginary($c, $d))
					->isEqualTo($this->newInstance($newRealPart, $newImaginaryPart))
		;
	}

	function testAdd()
	{
		$this
			->given($complex = new world\complex)

			->if($this->calling($complex)->addRealAndImaginary = $result = new complex)

			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->add($complex))->isIdenticalTo($result)
				->mock($complex)
					->call('addRealAndImaginary')->withArguments(new real, new real)->once

			->given($this->newTestedInstance($realPart = new real(rand(- PHP_INT_MAX, PHP_INT_MAX))))
			->then
				->object($this->testedInstance->add($complex))->isIdenticalTo($result)
				->mock($complex)
					->call('addRealAndImaginary')->withArguments($realPart, new real)->once

			->given($this->newTestedInstance($realPart = new real(- PHP_INT_MAX, PHP_INT_MAX), $imaginaryPart = new real(rand(- PHP_INT_MAX, PHP_INT_MAX))))
			->then
				->object($this->testedInstance->add($complex))->isIdenticalTo($result)
				->mock($complex)
					->call('addRealAndImaginary')->withArguments($realPart, $imaginaryPart)->once
		;
	}

	function testSubstract()
	{
		$this
			->given(
				$complex = new world\complex,
				$this->calling($complex)->opposite = $opposite = new world\complex,
				$this->calling($opposite)->add = $result = new world\complex
			)

			->if($this->newTestedInstance)
			->then
				->object($this->testedInstance->substract($complex))->isIdenticalTo($result)
				->mock($opposite)->call('add')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	function testMultiplyWithRealAndImaginary()
	{
		$this
			->given(
				$this->newTestedInstance($a = new world\real, $b = new world\real),
				$c = new world\real,
				$ca = new world\real,
				$cb = new world\real,
				$this->calling($c)->multiply = function($real) use ($a, $b, $cb, $ca) {
					switch (true)
					{
						case $real === $a:
							return $ca;

						case $real === $b:
							return $cb;
					}
				},
				$d = new world\real,
				$da = new world\real,
				$db = new world\real,
				$this->calling($d)->multiply = function($real) use ($a, $b, $da, $db) {
					switch (true)
					{
						case $real === $a:
							return $da;

						case $real === $b:
							return $db;
					}
				},
				$newRealPart = new world\real,
				$this->calling($ca)->substract = function($real) use ($db, $newRealPart) {
					if ($real === $db)
					{
						return $newRealPart;
					}
				},
				$newImaginaryPart = new world\real,
				$this->calling($da)->add = function($real) use ($cb, $newImaginaryPart) {
					if ($real === $cb)
					{
						return $newImaginaryPart;
					}
				}
			)
			->then
				->object($this->testedInstance->multiplyWithRealAndImaginary($c, $d))
					->isEqualTo($this->newInstance($newRealPart, $newImaginaryPart))
		;
	}

	function testMultiply()
	{
		$this
			->given(
				$complex = new world\complex,
				$this->calling($complex)->multiplyWithRealAndImaginary = $result = new complex
			)

			->if($this->newTestedInstance)
			->then
				->object($this->testedInstance->multiply($complex))->isIdenticalTo($result)
				->mock($complex)
					->call('multiplyWithRealAndImaginary')->withArguments(new real, new real)->once

			->if($this->newTestedInstance($realPart = new real(rand(- PHP_INT_MAX, PHP_INT_MAX))))
			->then
				->object($this->testedInstance->multiply($complex))->isIdenticalTo($result)
				->mock($complex)
					->call('multiplyWithRealAndImaginary')->withArguments($realPart, new real)->once

			->if($this->newTestedInstance($realPart = new real(rand(- PHP_INT_MAX, PHP_INT_MAX)), $imaginaryPart = new real(rand(- PHP_INT_MAX, PHP_INT_MAX))))
			->then
				->object($this->testedInstance->multiply($complex))->isIdenticalTo($result)
				->mock($complex)
					->call('multiplyWithRealAndImaginary')->withArguments($realPart, $imaginaryPart)->once
		;
	}

	function testDivide()
	{
		$this
			->given(
				$this->newTestedInstance,
				$complex = new world\complex,
				$this->calling($complex)->inverse = $inverse = new world\complex,
				$this->calling($inverse)->multiply = $result = new world\complex
			)

			->then
				->object($this->testedInstance->divide($complex))->isIdenticalTo($result)
				->mock($inverse)->call('multiply')->withIdenticalArguments($this->testedInstance)->once
		;
	}

	function testOpposite()
	{
		$this
			->given(
				$realPart = new world\real,
				$this->calling($realPart)->opposite = $oppositeRealPart = new world\real,
				$imaginaryPart = new world\real,
				$this->calling($imaginaryPart)->opposite = $oppositeImaginaryPart = new world\real,
				$this->newTestedInstance($realPart, $imaginaryPart)
			)
			->then
				->object($this->testedInstance->opposite())
					->isNotIdenticalTo($this->testedInstance)
					->isEqualTo($this->newInstance($oppositeRealPart, $oppositeImaginaryPart))
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

			->given($this->newTestedInstance(new real(1)))
			->then
				->object($this->testedInstance->inverse())
					->isNotIdenticalTo($this->testedInstance)
					->isEqualTo($this->newInstance(new real(1)))

			->given($this->newTestedInstance(new real(2)))
			->then
				->object($this->testedInstance->inverse())->isEqualTo($this->newInstance(new real(1/2)))

			->given($this->newTestedInstance(new real(2)))
			->then
				->object($this->testedInstance->inverse())->isEqualTo($this->newInstance(new real(1/2)))

			->given($this->newTestedInstance(new real(2), new real(3)))
			->then
				->object($this->testedInstance->inverse())->isEqualTo($this->newInstance(new real(2 / 13), new real(- 3 / 13)))
		;
	}
}
