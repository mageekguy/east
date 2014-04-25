<?php

namespace jobs\world\objects;

use
	jobs\world
;

interface box
{
	public function userOpen(box\user $user, callable $callable);
	public function userClose(box\user $user, callable $callable);
	public function userAdd(box\user $user, world\object $object);
	public function userRemove(box\user $user, $number, callable $callable = null);
	public function userRemoveAll(box\user $user, callable $callable = null);
}
