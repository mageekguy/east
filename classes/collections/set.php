<?php

namespace jobs\collections;

use
	jobs\world,
	jobs\collections
;

class set extends collections\bag implements world\collections\set
{
	public function ifContains(world\comparable $comparable, callable $containsCallable, callable $notContainsCallable = null)
	{
		return parent::walk(function($innerComparable, $key) use ($comparable, $containsCallable) {
					$innerComparable
						->isEqualTo($comparable)
							->ifTrue(function() use ($innerComparable, $key, $containsCallable) {
									$containsCallable($innerComparable, $key);

									$this->stop();
								}
							)
					;
				}
			)
			->ifNotStopped($notContainsCallable ?: function() {})
		;
	}
}
