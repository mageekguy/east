<?php

namespace jobs\world\objects;

use
	jobs\world
;

interface door extends world\object
{
	public function userOpen(door\user $user);
	public function userClose(door\user $user);
	public function userCross(door\user $user);
}
