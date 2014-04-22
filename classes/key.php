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

	public function display(world\object\properties $properties)
	{
		$properties->add('material', 'silver');
		$properties->add('pins', '532468');

		return $this;
	}
}
