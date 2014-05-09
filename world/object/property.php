<?php

namespace jobs\world\object;

use
	jobs\world
;

interface property
{
	function linkTo(world\object $object, world\area $area);
}
