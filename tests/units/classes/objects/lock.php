<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean,
	mock\jobs\world\objects,
	mock\jobs\world\objects\key\agent
;

class lock extends \atoum
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\objects\lockable');
	}

	function testAgentLock()
	{
		$this
			->given(
				$this->newTestedInstance($key = new objects\key()),
				$agent = new agent()
			)

			->if($this->calling($key)->isEqualTo = $false = new boolean\false)
			->then
				->object($this->testedInstance->agentLock($agent, $key))->isIdenticalTo($false)
				->mock($agent)->call('takeKey')->never

			->if($this->calling($key)->isEqualTo = $true = new boolean\true)
			->then
				->object($this->testedInstance->agentLock($agent, $key))->isIdenticalTo($true)
				->mock($agent)->call('takeKey')->withIdenticalArguments($this->testedInstance, $key)->once
		;
	}

	function testAgentUnLock()
	{
		$this
			->given(
				$this->newTestedInstance($key = new objects\key()),
				$agent = new agent()
			)

			->if($this->calling($key)->isEqualTo = $false = new boolean\false)
			->then
				->object($this->testedInstance->agentUnlock($agent, $key))->isIdenticalTo($false)
				->mock($agent)->call('takeKey')->never

			->if($this->calling($key)->isEqualTo = $true = new boolean\true)
			->then
				->object($this->testedInstance->agentUnlock($agent, $key))->isIdenticalTo($true)
				->mock($agent)->call('takeKey')->withIdenticalArguments($this->testedInstance, $key)->once
		;
	}
}
