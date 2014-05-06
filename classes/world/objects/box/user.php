<?php

namespace jobs\world\objects\box;

use
	jobs\world\objects\box,
	jobs\world\objects\key
;

interface user extends key\agent
{
	function openBox(box $box);
	function closeBox(box $box);
}
