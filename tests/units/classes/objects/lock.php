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

	public function testLock()
	{
		$this
			->given($this->newTestedInstance(new objects\key()))
			->then
				->exception(function() { $this->testedInstance->lock(function() {}); })
					->isInstanceOf('jobs\objects\lock\exception')
					->hasMessage('Key is missing')

			->given($this->testedInstance->takeKey($insertedKey = new objects\key()))

			->if($this->calling($insertedKey)->ifEqualTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->lock(function() use (& $lockFail) { $lockFail = true; }))->isTestedInstance
				->variable($lockFail)->isNull

			->if($this->calling($insertedKey)->ifEqualTo->doesNothing)
			->then
				->object($this->testedInstance->lock(function() use (& $lockFail) { $lockFail = true; }))->isTestedInstance
				->variable($lockFail)->isNull

			->given(
				$this->calling($insertedKey)->ifEqualTo = function($comparable, $callable) { $callable(); },
				$this->testedInstance->unlock(function() {})
			)
			->then
				->object($this->testedInstance->lock(function() use (& $lockFail) { $lockFail = true; }))->isTestedInstance
				->variable($lockFail)->isNull

			->given(
				$this->calling($insertedKey)->ifEqualTo = function($comparable, $callable) { $callable(); },
				$this->testedInstance->unlock(function() {})
			)

			->if($this->calling($insertedKey)->ifEqualTo->doesNothing)
			->then
				->object($this->testedInstance->lock(function() use (& $lockFail) { $lockFail = true; }))->isTestedInstance
				->boolean($lockFail)->isTrue
		;
	}

	public function testUnlock()
	{
		$this
			->given($this->newTestedInstance(new objects\key()))
			->then
				->exception(function() { $this->testedInstance->unlock(function() {}); })
					->isInstanceOf('jobs\objects\lock\exception')
					->hasMessage('Key is missing')

			->given($this->testedInstance->takeKey($insertedKey = new objects\key()))

			->if($this->calling($insertedKey)->ifEqualTo = function($comparable, $callable) { $callable(); })
			->then
				->object($this->testedInstance->unlock(function() use (& $unlockFail) { $unlockFail = true; }))->isTestedInstance
				->variable($unlockFail)->isNull

				->object($this->testedInstance->unlock(function() use (& $unlockFail) { $unlockFail = true; }))->isTestedInstance
				->variable($unlockFail)->isNull

			->if(
				$this->testedInstance->lock(function() {}),
				$this->calling($insertedKey)->ifEqualTo->doesNothing
			)
			->then
				->object($this->testedInstance->unlock(function() use (& $unlockFail) { $unlockFail = true; }))->isTestedInstance
				->boolean($unlockFail)->isTrue
		;
	}
}
