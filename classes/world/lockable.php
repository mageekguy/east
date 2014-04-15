<?php

namespace jobs\world;

interface lockable extends key\aggregator
{
	public function lock();
	public function unlock();
}
