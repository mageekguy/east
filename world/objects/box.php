<?php

namespace jobs\world\objects;

use
	jobs\world
;

interface box extends world\object
{
	function userOpen(box\user $user);
	function userClose(box\user $user);
	function userAddObject(box\user $user, world\object $object);
	function userRemoveObject(box\user $user);
	function userRemoveObjects(box\user $user);
}
