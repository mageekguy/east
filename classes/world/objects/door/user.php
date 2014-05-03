<?php

namespace jobs\world\objects\door;

use
	jobs\world\area,
	jobs\world\objects\door
;

interface user
{
	public function openDoor(door $door);
	public function closeDoor(door $door);
	public function enterInArea(area $area);
}
