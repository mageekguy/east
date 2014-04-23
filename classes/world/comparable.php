<?php

namespace jobs\world;

interface comparable
{
	public function ifEqualTo(self $comparable, callable $callable);
	public function ifIdenticalTo(self $comparable, callable $callable);
}
