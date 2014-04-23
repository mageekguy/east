<?php

namespace jobs\objects;

use
	jobs\world
;

class key implements world\objects\key
{
	public function ifEqualTo(world\comparable $comparable, callable $callable)
	{
		$comparable->ifEqualTo($this, $callable);

		return $this;
	}

	public function ifIdenticalTo(world\comparable $comparable, callable $callable)
	{
		$comparable->ifIdenticalTo($this, $callable);

		return $this;
	}

	public function addIn(world\area $area)
	{
		return $this;
	}
}
