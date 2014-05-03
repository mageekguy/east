<?php

namespace jobs\tests\units\objects;

require __DIR__ . '/../../runner.php';

use
	jobs\boolean,
	jobs\tests\units,
	mock\jobs\world\area,
	mock\jobs\world\comparable,
	mock\jobs\world\objects\door\user
;

class door extends units\test
{
	function testClass()
	{
		$this->testedClass->implements('jobs\world\objects\door');
	}

	function testIsEqualTo()
	{
		$this
			->given($this->newTestedInstance(new area))
			->then
				->boolean($this->testedInstance->isEqualTo($this->testedInstance))->isTrue
				->boolean($this->testedInstance->isEqualTo(clone $this->testedInstance))->isTrue
				->boolean($this->testedInstance->isEqualTo(new comparable))->isFalse
		;
	}

	function testIsIdenticalTo()
	{
		$this
			->given($this->newTestedInstance(new area))
			->then
				->boolean($this->testedInstance->isIdenticalTo($this->testedInstance))->isTrue
				->boolean($this->testedInstance->isIdenticalTo(clone $this->testedInstance))->isFalse
				->boolean($this->testedInstance->isIdenticalTo(new comparable))->isFalse
		;
	}

	function testUserOpen()
	{
		$this
			->given(
				$user = new user,
				$this->newTestedInstance(new area)
			)

			->if($this->calling($user)->openDoor = new boolean\false)
			->then
				->boolean($this->testedInstance->userOpen($user))->isFalse
				->mock($user)
					->call('openDoor')->withIdenticalArguments($this->testedInstance)->once

			->if($this->calling($user)->openDoor = new boolean\true)
			->then
				->boolean($this->testedInstance->userOpen($user))->isTrue
				->mock($user)
					->call('openDoor')->withIdenticalArguments($this->testedInstance)->twice
		;
	}

	function testUserClose()
	{
		$this
			->given(
				$user = new user,
				$this->newTestedInstance(new area)
			)

			->if($this->calling($user)->closeDoor = new boolean\false)
			->then
				->boolean($this->testedInstance->userClose($user))->isFalse
				->mock($user)
					->call('closeDoor')->withIdenticalArguments($this->testedInstance)->once

			->if($this->calling($user)->closeDoor = new boolean\true)
			->then
				->boolean($this->testedInstance->userClose($user))->isTrue
				->mock($user)
					->call('closeDoor')->withIdenticalArguments($this->testedInstance)->twice
		;
	}

	function testUserCross()
	{
		$this
			->given(
				$user = new user,
				$area = new area,
				$this->newTestedInstance($area)
			)

			->if($this->calling($user)->openDoor = new boolean\false)
			->then
				->boolean($this->testedInstance->userCross($user))->isFalse
				->mock($user)
					->call('openDoor')->withIdenticalArguments($this->testedInstance)->once
		;
	}
}
