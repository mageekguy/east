<?php

namespace jobs\world;

interface complex
{
	public function addTo($realPart, $imaginaryPart = 0.);
	public function addToComplex(self $complex);

	public function multiplyWith($realPart, $imaginaryPart = 0.);
	public function multiplyWithComplex(self $complex);
}
