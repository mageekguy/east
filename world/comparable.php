<?php

namespace jobs\world;

interface comparable
{
	function isEqualTo(self $comparable);
	function isIdenticalTo(self $comparable);
}
