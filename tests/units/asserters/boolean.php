<?php

namespace jobs\tests\units\asserters;

use
	jobs\world,
	mageekguy\atoum\asserters
;

class boolean extends asserters\object
{
	public function __get($property)
	{
		switch (strtolower($property))
		{
			case 'isfalse':
			case 'istrue':
				return $this->{$property}();

			default:
				return parent::__get($property);
		}
	}

	public function setWith($value)
	{
		parent::setWith($value);

		if ($this->value instanceof world\boolean)
		{
			$this->pass();
		}
		else
		{
			$this->fail($this->_('%s is not a boolean object', $this));
		}

		return $this;
	}

	public function isEqualTo($value, $failMessage = null)
	{
		$isTrue = false;

		$this->valueIsSet()->value->ifTrue(function() use (& $isTrue) { $isTrue = true; });

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

	public function isTrue($failMessage = null)
	{
		return $this->isEqualTo(true, $failMessage ?: $this->_('boolean is not true'));
	}

	public function isFalse($failMessage = null)
	{
		return $this->isEqualTo(false, $failMessage ?: $this->_('boolean is not false'));
	}
}
