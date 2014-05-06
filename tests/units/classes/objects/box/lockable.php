<?php

namespace jobs\tests\units\objects\box;

require __DIR__ . '/../../../runner.php';

use
	jobs\boolean,
	mock\jobs\world\area,
	mock\jobs\world\objects
;

class lockable extends \atoum
{
	function testClass()
	{
		$this->testedClass->extends('jobs\objects\box');
	}

	function testUserOpen()
	{
		$this
			->given(
				$this->newTestedInstance($key = new objects\key()),
				$user = new objects\box\user(),
				$this->calling($user)->unlock = $true = new boolean\true()
			)
			->then
				->object($this->testedInstance->userOpen($user, $key))->isIdenticalTo($true)
		;
	}

	function testUserClose()
	{
		$this
			->given(
				$this->newTestedInstance(new objects\key()),
				$user = new objects\box\user()
			)

			->if($this->calling($user)->lock = $true = new boolean\true())
			->then
				->object($this->testedInstance->userClose($user))->isIdenticalTo($true)
				->mock($user)->call('lock')->withIdenticalArguments($this->testedInstance)->once

			->if($this->calling($user)->lock = $false = new boolean\false())
			->then
				->object($this->testedInstance->userClose($user))->isIdenticalTo($false)
				->mock($user)->call('lock')->withIdenticalArguments($this->testedInstance)->twice
		;
	}

	function testAgentLock()
	{
		$this
			->given(
				$this->newTestedInstance(new objects\key()),
				$agent = new objects\key\agent(),
				$key = new objects\key()
			)

			->if($this->calling($key)->isEqualTo = $true = new boolean\true())
			->then
				->object($this->testedInstance->agentLock($agent, $key))->isIdenticalTo($true)

			->if($this->calling($key)->isEqualTo = $false = new boolean\false())
			->then
				->object($this->testedInstance->agentLock($agent, $key))->isIdenticalTo($false)
		;
	}

	function testAgentUnlock()
	{
		$this
			->given(
				$this->newTestedInstance(new objects\key()),
				$agent = new objects\key\agent(),
				$key = new objects\key()
			)

			->if($this->calling($key)->isEqualTo = $true = new boolean\true())
			->then
				->object($this->testedInstance->agentUnlock($agent, $key))->isIdenticalTo($true)

			->if($this->calling($key)->isEqualTo = $false = new boolean\false())
			->then
				->object($this->testedInstance->agentUnlock($agent, $key))->isIdenticalTo($false)
		;
	}

	function testEnterInArea()
	{
		$this
			->given(
				$this->newTestedInstance(new objects\key()),
				$area = new area
			)
			->then
				->object($this->testedInstance->enterInArea($area))->isTestedInstance
				->mock($area)->call('objectEnter')->withIdenticalArguments($this->testedInstance)->once
		;
	}
}
