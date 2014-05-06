<?php

namespace jobs\world;

interface collection
{
	function walk(callable $callable);
	function apply($mixed, callable $callable);
	function contains($mixed);
}
