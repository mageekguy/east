<?php

namespace jobs\world;

interface area
{
	function objectEnter(object $object);
	function objectLeave(object $object);
}
