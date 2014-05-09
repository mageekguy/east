<?php

namespace jobs\world\collections;

use jobs\world;

interface bag
{
	function add(world\comparable $comparable);
	function remove(world\comparable $comparable);
	function walk(callable $callable);
	function apply($key, callable $callable);
	function contains(world\comparable $comparable);
}
