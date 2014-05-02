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

	public function addToComplex(world\complex $complex)
	{
		$complex->addTo($this->realPart, $this->imaginaryPart);

		return $this;
	}

	public function multiplyWithComplex(world\complex $complex)
	{
		$complex->multiplyWith($this->realPart, $this->imaginaryPart);

		return $this;
	}

	public function addTo($realPart, $imaginaryPart = 0.)
	{
		return $this->setWith($this->realPart + $realPart, $this->imaginaryPart + $imaginaryPart);
	}

	public function multiplyWith($realPart, $imaginaryPart = 0.)
	{
		return $this->setWith(($this->realPart * $realPart) - ($this->imaginaryPart * $imaginaryPart), ($this->realPart * $imaginaryPart) + ($this->imaginaryPart * $realPart));
	}

	private function setWith($realPart, $imaginaryPart)
	{
		$this->realPart = (float) $realPart;
		$this->imaginaryPart = (float) $imaginaryPart;

		return $this;
	}
}
