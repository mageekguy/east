<?php

namespace jobs\objects;

use
	jobs,
	jobs\world,
	jobs\world\objects
;

class door implements objects\door
{
	private $area = null;

	public function __construct(world\area $area)
	{
		$this->area = $area;
	}

	public function isEqualTo(world\comparable $comparable)
	{
		return new jobs\boolean($this == $comparable);
	}

	public function isIdenticalTo(world\comparable $comparable)
	{
		return new jobs\boolean($this === $comparable);
	}

	public function userOpen(objects\door\user $user)
	{
		return $user->openDoor($this);
	}

	public function userClose(objects\door\user $user)
	{
		return $user->closeDoor($this);
	}

	public function userCross(objects\door\user $user)
	{
		return $user
			->openDoor($this)
				->ifTrue(function() use ($user) {
						$user->enterInArea($this->area);
					}
				)
		;
	}
}
