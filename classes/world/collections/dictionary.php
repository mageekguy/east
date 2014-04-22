<?php

namespace jobs\world\collections;

use jobs\world;

interface dictionary extends world\collection
{
	public function add(world\comparable $comparable, $value);
	public function remove(world\comparable $comparable);
	public function apply(world\comparable $comparable, callable $callable);
}
