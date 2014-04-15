<?php

namespace jobs;

class key implements world\key
{
	public function match(world\key $key)
	{
		if ($this != $key)
		{
			throw new key\exception('Key does not match');
		}

		return $this;
	}
}
