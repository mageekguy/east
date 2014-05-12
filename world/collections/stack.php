<?php

namespace jobs\world\collections;

use jobs\world;

interface stack
{
	function push($value);
	function pop();
	function walk(callable $callable);
	function apply(callable $callable);
}
