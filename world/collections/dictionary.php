<?php

namespace jobs\world\collections;

use jobs\world;

interface dictionary
{
	function add(world\comparable $comparable, $value);
	function remove(world\comparable $comparable);
	function apply(world\comparable $comparable, callable $callable);
	function walk(callable $callable);
}
