<?php

namespace jobs\world;

interface area
{
	public function objectEnter(object $object);
	public function objectLeave(object $object);
}
