<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	mock\jobs\world\objects,
	mock\jobs\world\objects\key\agent
;

class lock extends \atoum
{
	public function testClass()
	{
		$this->testedClass->implements('jobs\world\objects\lockable');
	}

	public function testAgentLock()
	{
		$this
			->given(
				$this->newTestedInstance($key = new objects\key()),
				$agent = new agent()
			)

			->if(
				$this->calling($agent)->insertKeyIn->doesNothing,
				$this->calling($key)->ifEqualTo->doesNothing
			)
			->then
				->object($this->testedInstance->agentLock($agent, function() use (& $locked) { $locked = true; }))->isTestedInstance
				->variable($locked)->isNull

			->if($this->calling($agent)->insertKeyIn = function($lock, $callable) use ($key) { $callable($key); })
			->then
				->object($this->testedInstance->agentLock($agent, function() use (& $locked) { $locked = true; }))->isTestedInstance
				->variable($locked)->isNull

			->if($this->calling($key)->ifEqualTo = function($key, $callable) { $callable(); })
			->then
				->object($this->testedInstance->agentLock($agent, function() use (& $locked) { $locked = true; }))->isTestedInstance
				->boolean($locked)->isTrue
				->mock($agent)->call('takeKey')->withIdenticalArguments($this->testedInstance, $key)->once
		;
	}

	public function testAgentUnLock()
	{
		$this
			->given(
				$this->newTestedInstance($key = new objects\key()),
				$agent = new agent()
			)

			->if(
				$this->calling($agent)->insertKeyIn->doesNothing,
				$this->calling($key)->ifEqualTo->doesNothing
			)
			->then
				->object($this->testedInstance->agentUnlock($agent, function() use (& $locked) { $locked = true; }))->isTestedInstance
				->variable($locked)->isNull

			->if($this->calling($agent)->insertKeyIn = function($lock, $callable) use ($key) { $callable($key); })
			->then
				->object($this->testedInstance->agentUnlock($agent, function() use (& $locked) { $locked = true; }))->isTestedInstance
				->variable($locked)->isNull

			->if($this->calling($key)->ifEqualTo = function($key, $callable) { $callable(); })
			->then
				->object($this->testedInstance->agentUnlock($agent, function() use (& $locked) { $locked = true; }))->isTestedInstance
				->boolean($locked)->isTrue
				->mock($agent)->call('takeKey')->withIdenticalArguments($this->testedInstance, $key)->once
		;
	}
}
