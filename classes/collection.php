<?php

namespace jobs;

use
	jobs\world
;

class collection implements world\collection
{
	private $stopped = false;
	private $values = array();

	public function count()
	{
		return count($this->values);
	}

	public function add($value, $key = null)
	{
		if ($key === null)
		{
			$this->values[] = $value;
		}
		else
		{
			$this->values[$key] = $value;
		}

		return $this;
	}

	public function remove($key, callable $callable = null)
	{
		return $this->apply($key, function($value) use ($key, $callable) {
				if ($callable !== null)
				{
					$callable($value);
				}

				unset($this->values[$key]);
			}
		);
	}

	public function removeLast(callable $callable = null, $number = 1)
	{
		while (($key = $this->getLastKey()) !== null && $number-- > 0)
		{
			$this->remove($key, $callable);
		}

		return $this;
	}

	public function walk(callable $callable)
	{
		$this->stopped = false;

		foreach ($this->values as $key => $value)
		{
			call_user_func_array($callable, array($value, $key));

			if ($this->stopped === true)
			{
				break;
			}
		}

		return $this;
	}

	public function apply($key, callable $callable)
	{
		if (isset($this->values[$key]) === true)
		{
			call_user_func_array($callable, array($this->values[$key]));
		}

		return $this;
	}

	public function stop()
	{
		$this->stopped = true;

		return $this;
	}

	public function ifNotStopped(callable $callable)
	{
		if ($this->stopped === false)
		{
			$callable();
		}

		return $this;
	}

	private function getLastKey()
	{
		end($this->values);
		$key = key($this->values);

		return ($key === false ? null : $key);
	}
}
