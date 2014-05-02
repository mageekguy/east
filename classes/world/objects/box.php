<?php

namespace jobs\world\objects;

use
	jobs\world
;

interface box
{
	public function userOpen(box\user $user);
	public function userClose(box\user $user);
	public function userAddObject(box\user $user, world\object $object);
	public function userRemoveObject(box\user $user);
	public function userRemoveObjects(box\user $user);
}
