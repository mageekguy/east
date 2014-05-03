<?php

namespace jobs\world;

interface complex
{
	public function addComplex(self $complex);
	public function addToComplex(self $complex);
	public function add($realPart, $imaginaryPart = 0.);

	public function multiplyWithComplex(self $complex);
	public function multiplyComplex(self $complex);
	public function multiply($realPart, $imaginaryPart = 0.);

	public function hasModuleGreaterThan($float);
}
