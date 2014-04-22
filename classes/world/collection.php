<?php

namespace jobs\world;

interface collection extends \countable
{
	public function walk(callable $callable);
	public function stop();
	public function ifNotStopped(callable $callable);
}
