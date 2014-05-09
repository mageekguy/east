<?php

namespace jobs\world\objects;

use
	jobs\world
;

interface door extends world\object
{
	function userOpen(door\user $user);
	function userClose(door\user $user);
	function userCross(door\user $user);
}
