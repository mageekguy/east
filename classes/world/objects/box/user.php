<?php

namespace jobs\world\objects\box;

use
	jobs\world\objects\box,
	jobs\world\objects\key
;

interface user extends key\agent
{
	public function openBox(box $box, callable $callable = null);
	public function closeBox(box $box, callable $callable = null);
}
