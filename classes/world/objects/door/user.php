<?php

namespace jobs\world\objects\door;

use
	jobs\world,
	jobs\world\area,
	jobs\world\objects\door
;

interface user extends world\object
{
	function openDoor(door $door);
	function closeDoor(door $door);
	function enterInArea(area $area);
}
