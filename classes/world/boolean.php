<?php

namespace jobs\world;

interface boolean
{
	public function ifTrue(callable $callable);
	public function ifFalse(callable $callable);
}
