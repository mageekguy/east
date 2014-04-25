<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world\objects
;

class lock extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\objects\lockable');
	}

	public function testTakeKey()
	{
		$this
			->given(
				$this->newTestedInstance(new objects\key()),
				$key = new objects\key()
			)
			->then
				->object($this->testedInstance->takeKey($key))->isTestedInstance

				->exception(function() use ($key) { $this->testedInstance->takeKey($key); })
					->isInstanceOf('jobs\objects\lock\exception')
					->hasMessage('I can accept only one key at a time')
		;
	}

	public function testGiveKey()
	{
		$this
			->given(
				$this->newTestedInstance(new objects\key()),
				$agent = new objects\key\agent()
			)
			->then
				->exception(function() use ($agent) { $this->testedInstance->giveKey($agent); })
					->isInstanceOf('jobs\objects\lock\exception')
					->hasMessage('I have no key')

			->if($this->testedInstance->takeKey($key = new objects\key()))
			->then
				->object($this->testedInstance->giveKey($agent))->isTestedInstance
				->mock($agent)->call('takeKey')->withArguments($key)->once

				->exception(function() use ($agent) { $this->testedInstance->giveKey($agent); })
					->isInstanceOf('jobs\objects\lock\exception')
					->hasMessage('I have no key')
		;
	}

	public function testIfKeyMatch()
	{
		$this
			->given($this->newTestedInstance(new objects\key()))
			->then
				->object($this->testedInstance->ifKeyMatch(function() {}))->isTestedInstance

			->given($this->testedInstance->takeKey($insertedKey = new objects\key()))
			->then
				->object($this->testedInstance->ifKeyMatch(function() use (& $unlocked) { $unlocked = true; }))->isTestedInstance
				->variable($unlocked)->isNull

			->if($this->calling($insertedKey)->ifEqualTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->ifKeyMatch(function() use (& $unlocked) { $unlocked = true; }))->isTestedInstance
				->boolean($unlocked)->isTrue
		;
	}
}
