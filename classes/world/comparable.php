<?php

namespace jobs\world;

interface comparable
{
	public function isEqualTo(self $comparable);
	public function isIdenticalTo(self $comparable);
}
