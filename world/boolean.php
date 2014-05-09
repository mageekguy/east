<?php

namespace jobs\world;

interface boolean
{
	function ifTrue(callable $callable);
	function ifFalse(callable $callable);
}
