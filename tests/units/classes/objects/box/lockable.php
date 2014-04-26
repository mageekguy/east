<?php

namespace jobs\tests\units\objects\box;

require __DIR__ . '/../../../runner.php';

use
	mock\jobs\world\objects
;

class lockable extends \atoum
{
	public function testClass()
	{
		$this->testedClass->extends('jobs\objects\box');
	}

	public function testUserOpen()
	{
		$this
			->given(
				$this->newTestedInstance($key = new objects\key()),
				$this->calling($key)->ifEqualTo = function($key, $callable) { $callable(); },
				$user = new objects\box\user(),
				$this->calling($user)->insertKeyIn = function($lock, $callable) use ($key) { $callable($key); }
			)
			->then
				->object($this->testedInstance->userOpen($user, function() use (& $unlocked) { $unlocked = true; }))->isTestedInstance
				->boolean($unlocked)->isTrue
		;
	}

	public function testUserClose()
	{
		$this
			->given(
				$this->newTestedInstance($key = new objects\key()),
				$this->calling($key)->ifEqualTo = function($key, $callable) { $callable(); },
				$user = new objects\box\user(),
				$this->calling($user)->insertKeyIn = function($lock, $callable) use ($key) { $callable($key); }
			)
			->then
				->object($this->testedInstance->userClose($user, function() use (& $locked) { $locked = true; }))->isTestedInstance
				->boolean($locked)->isTrue
		;
	}
}
