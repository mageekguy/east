<?php

namespace jobs\world;

interface complex
{
	function add(self $complex);
	function substract(self $complex);
	function multiply(self $complex);
	function divide(self $complex);

	function inverse();
	function opposite();

	function addRealAndImaginary(real $real, real $imaginary = null);
	function multiplyWithRealAndImaginary(real $real, real $imaginary = null);
}
