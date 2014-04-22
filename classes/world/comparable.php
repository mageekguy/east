<?php

namespace jobs\world;

interface comparable
{
	public function ifEqualTo(self $comparable, callable $callable = null);
}
