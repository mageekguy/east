<?php

namespace jobs\tests\units\asserters;

use
	jobs\world,
	mageekguy\atoum\asserters
;

class collection extends asserters\object
{
	public function setWith($value)
	{
		parent::setWith($value);

		if ($this->value instanceof world\collection)
		{
			$this->pass();
		}
		else
		{
			$this->fail($this->_('%s is not a collection object', $this));
		}

		return $this;
	}

	public function containsAt($key, $value, $failMessage = null)
	{
		$this->valueIsSet()->value->apply($key, function() use (& $isTrue) { $isTrue = true; });

		if ($isTrue == $value)
		{
			$this->pass();
		}
		else
		{
			$this->fail(($failMessage ?: $this->_('%s is not equal to %s', $this, $this->getTypeOf($value))));
		}

		return $this;
	}
}
