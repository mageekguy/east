<?php

namespace jobs\tests\units;

class test extends \atoum
{
	public function beforeTestMethod($method)
	{
		$this->define->boolean = 'jobs\tests\units\asserters\boolean';
	}
}
