<?php

namespace jobs\tests\units;

require __DIR__ . '/../runner.php';

class lockable extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\lockable');
	}

	public function testTakeKey()
	{
		$this
			->given(
				$this->newTestedInstance(new \mock\jobs\world\key()),
				$key = new \mock\jobs\world\key()
			)
			->then
				->object($this->testedInstance->takeKey($key))->isTestedInstance

				->exception(function() use ($key) { $this->testedInstance->takeKey($key); })
					->isInstanceOf('jobs\lockable\exception')
					->hasMessage('I can accept only one key at a time')
		;
	}

	public function testGiveKey()
	{
		$this
			->given(
				$this->newTestedInstance(new \mock\jobs\world\key()),
				$agent = new \mock\jobs\world\key\agent()
			)
			->then
				->exception(function() use ($agent) { $this->testedInstance->giveKey($agent); })
					->isInstanceOf('jobs\lockable\exception')
					->hasMessage('I have no key')

			->if($this->testedInstance->takeKey($key = new \mock\jobs\world\key()))
			->then
				->object($this->testedInstance->giveKey($agent))->isTestedInstance
				->mock($agent)->call('takeKey')->withArguments($key)->once

				->exception(function() use ($agent) { $this->testedInstance->giveKey($agent); })
					->isInstanceOf('jobs\lockable\exception')
					->hasMessage('I have no key')
		;
	}

	public function testLock()
	{
		$this
			->given($this->newTestedInstance(new \mock\jobs\world\key()))
			->then
				->exception(function() { $this->testedInstance->lock(); })
					->isInstanceOf('jobs\lockable\exception')
					->hasMessage('Key is missing')

			->given($this->testedInstance->takeKey($insertedKey = new \mock\jobs\world\key()))
			->if($this->calling($insertedKey)->match->isFluent)
			->then
				->object($this->testedInstance->lock())->isTestedInstance
				->object($this->testedInstance->lock())->isTestedInstance

			->if($this->calling($insertedKey)->match->throw = new \exception())
			->then
				->exception(function() { $this->testedInstance->lock(); })
					->isInstanceOf('jobs\lockable\exception')
					->hasMessage('Key does not match')
		;
	}

	public function testUnlock()
	{
		$this
			->given($this->newTestedInstance(new \mock\jobs\world\key()))
			->then
				->exception(function() { $this->testedInstance->unlock(); })
					->isInstanceOf('jobs\lockable\exception')
					->hasMessage('Key is missing')

			->given($this->testedInstance->takeKey($insertedKey = new \mock\jobs\world\key()))
			->if($this->calling($insertedKey)->match->isFluent)
			->then
				->object($this->testedInstance->unlock())->isTestedInstance
				->object($this->testedInstance->unlock())->isTestedInstance

			->if($this->calling($insertedKey)->match->throw = new \exception())
			->then
				->exception(function() { $this->testedInstance->unlock(); })
					->isInstanceOf('jobs\lockable\exception')
					->hasMessage('Key does not match')
		;
	}
}
