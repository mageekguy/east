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

	function __construct(world\area $area)
	{
		$this->area = $area;
	}

	function isEqualTo(world\comparable $comparable)
	{
		return new jobs\boolean($this == $comparable);
	}

	function isIdenticalTo(world\comparable $comparable)
	{
		return new jobs\boolean($this === $comparable);
	}

	function userOpen(objects\door\user $user)
	{
		return $user->openDoor($this);
	}

	function userClose(objects\door\user $user)
	{
		return $user->closeDoor($this);
	}

	function userCross(objects\door\user $user)
	{
		return $user
			->openDoor($this)
				->ifTrue(function() use ($user) {
						$this->area->objectEnter($user);
					}
				)
		;
	}

	function enterInArea(world\area $area)
	{
		$area->addDoor($this);

		return $this;
	}
}
