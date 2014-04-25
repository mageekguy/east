<?php

namespace jobs\world\object;

use
	jobs\world
;

interface property
{
	public function linkTo(world\object $object, world\area $area);
}
