<?php

namespace jobs\world\objects\door;

use
	jobs\world,
	jobs\world\area,
	jobs\world\objects\door
;

interface user extends world\object
{
	public function openDoor(door $door);
	public function closeDoor(door $door);
	public function enterInArea(area $area);
}
