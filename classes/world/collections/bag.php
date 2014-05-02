<?php

namespace jobs\world\collections;

use jobs\world;

interface bag
{
	public function add(world\comparable $comparable);
	public function remove(world\comparable $comparable);
	public function walk(callable $callable);
	public function apply($key, callable $callable);
	public function contains(world\comparable $comparable);
}
