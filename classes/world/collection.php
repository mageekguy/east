<?php

namespace jobs\world;

interface collection
{
	public function walk(callable $callable);
	public function apply($mixed, callable $callable);
	public function contains($mixed);
}
