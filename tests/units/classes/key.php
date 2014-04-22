<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

class key extends \atoum
{
	public function testClass()
	{
		$this->testedClass
			->implements('jobs\world\key')
		;
	}

	public function testMatch()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->match($this->testedInstance))->isTestedInstance
				->object($this->testedInstance->match(clone $this->testedInstance))->isTestedInstance
				->exception(function() { $this->testedInstance->match(new \mock\jobs\world\key()); })
					->isInstanceOf('jobs\key\exception')
					->hasMessage('Key does not match')
		;
	}

	public function testDisplay()
	{
		$this
			->given($this->newTestedInstance)
			->then
				->object($this->testedInstance->display($properties = new \mock\jobs\world\object\properties()))->isTestedInstance
				->mock($properties)->call('add')
					->withArguments('material', 'silver')->once
					->withArguments('pins', '532468')->once
		;
	}
}
