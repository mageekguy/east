<?php

namespace jobs;

class real implements world\real
{
	private $value = 0.;

	function __construct($value = 0.)
	{
		$this->value = (float) $value;
	}

	function addValue($value)
	{
		if ($value instanceof world\complex)
		{
			return $value->add($this);
		}

		return new self($this->value + $value);
	}

	function addRealAndImaginary(world\real $realPart, world\real $imaginaryPart = null)
	{
		return self::build($realPart->addValue($this->value), $imaginaryPart);
	}

	function add(world\complex $complex)
	{
		return $complex->addRealAndImaginary($this);
	}

	function substract(world\complex $complex)
	{
		return $complex->opposite()->add($this);
	}

	function multiplyWithValue($value)
	{
		if ($value instanceof world\complex)
		{
			return $value->multiply($this);
		}

		return new self($this->value * $value);
	}

	function multiplyWithRealAndImaginary(world\real $realPart, world\real $imaginaryPart = null)
	{
		return self::build($realPart->multiplyWithValue($this->value), $imaginaryPart);
	}

	function multiply(world\complex $complex)
	{
		return $complex->multiplyWithRealAndImaginary($this);
	}

	function divide(world\complex $complex)
	{
		return $complex->inverse()->multiply($this);
	}

	function inverse()
	{
		if ($this->value == 0)
		{
			throw new \runtimeException('Division by zero!');
		}

		return new self(1 / $this->value);
	}

	function opposite()
	{
		return new self(- $this->value);
	}

	private static function build(self $realPart, world\real $imaginaryPart = null)
	{
		if ($imaginaryPart !== null)
		{
			$realPart = new complex($realPart, $imaginaryPart);
		}

		return $realPart;
	}
}
