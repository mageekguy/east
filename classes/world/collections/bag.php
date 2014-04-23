<?php

namespace jobs\world\collections;

use jobs\world;

interface bag extends world\collection
{
	public function add(world\comparable $comparable);
	public function remove(world\comparable $comparable);
	public function apply($key, callable $callable);
	public function ifContains(world\comparable $comparable, callable $containsCallable, callable $notContainsCallable = null);
}
