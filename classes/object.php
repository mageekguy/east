<?php

namespace jobs;

use
	jobs\world
;

class object
{
	private $area = null;

	public function enterInArea(world\area $area)
	{
		$this->area = $area;

		return $this;
	}
}
