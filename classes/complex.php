<?php

namespace jobs;

class complex implements world\complex
{
	private $realPart = 0.;
	private $imaginaryPart = 0.;

	public function __construct($realPart = 0., $imaginaryPart = 0.0)
	{
		$this->setWith($realPart, $imaginaryPart);
	}

	public function addComplex(world\complex $complex)
	{
		$complex->addToComplex($this);

		return $this;
	}

	public function addToComplex(world\complex $complex)
	{
		$complex->add($this->realPart, $this->imaginaryPart);

		return $this;
	}

	public function add($realPart, $imaginaryPart = 0.)
	{
		return $this->setWith($this->realPart + $realPart, $this->imaginaryPart + $imaginaryPart);
	}

	public function multiplyWithComplex(world\complex $complex)
	{
		$complex->multiplyComplex($this);

		return $this;
	}

	public function multiplyComplex(world\complex $complex)
	{
		$complex->multiply($this->realPart, $this->imaginaryPart);

		return $this;
	}

	public function multiply($realPart, $imaginaryPart = 0.)
	{
		return $this->setWith(($this->realPart * $realPart) - ($this->imaginaryPart * $imaginaryPart), ($this->realPart * $imaginaryPart) + ($this->imaginaryPart * $realPart));
	}

	public function hasModuleGreaterThan($float)
	{
		return new boolean(sqrt(pow($this->realPart, 2) + pow($this->imaginaryPart, 2)) > $float);
	}

	private function setWith($realPart, $imaginaryPart)
	{
		$this->realPart = (float) $realPart;
		$this->imaginaryPart = (float) $imaginaryPart;

		return $this;
	}
}
