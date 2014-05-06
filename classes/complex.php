<?php

namespace jobs;

use
	jobs\world
;

class complex implements world\complex
{
	private $a = null;
	private $b = null;

	function __construct(world\real $a = null, world\real $b = null)
	{
		$this->a = $a ?: new real;
		$this->b = $b ?: new real;
	}

	function add(world\complex $complex)
	{
		return $complex->addRealAndImaginary($this->a, $this->b);
	}

	function addRealAndImaginary(world\real $c, world\real $d = null)
	{
		if ($d === null)
		{
			$d = new real;
		}

		return new self($c->add($this->a), $d->add($this->b));
	}

	function substract(world\complex $complex)
	{
		return $complex->opposite()->add($this);
	}

	function multiply(world\complex $complex)
	{
		return $complex->multiplyWithRealAndImaginary($this->a, $this->b);
	}

	function multiplyWithRealAndImaginary(world\real $c, world\real $d = null)
	{
		if ($d === null)
		{
			$d = new real;
		}

		return new self(
			$c->multiply($this->a)->substract($d->multiply($this->b)),
			$d->multiply($this->a)->add($c->multiply($this->b))
		);
	}

	function divide(world\complex $complex)
	{
		return $complex->inverse()->multiply($this);
	}

	function opposite()
	{
		return new self($this->a->opposite(), $this->b->opposite());
	}

	function inverse()
	{
		$sumOfa²Andb² = $this->a->multiply($this->a)->add($this->b->multiply($this->b));

		return new self($this->a->divide($sumOfa²Andb²), $this->b->opposite()->divide($sumOfa²Andb²));
	}
}
