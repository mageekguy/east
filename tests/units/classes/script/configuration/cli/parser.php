<?php

namespace jobs\tests\units\script\configuration\cli;

require __DIR__ . '/../../../../runner.php';

use
	jobs\tests\units,
	mock\jobs\world\configuration
;

class parser extends units\test
{
	public function testParse()
	{
		$this
			->given(
				$this->newTestedInstance(function($optionName, $optionArguments) use (& $cli) {
						$cli[$optionName] = $optionArguments;
					}
				)
			)
			->then
				->object($this->testedInstance->parse([]))->isTestedInstance
				->variable($cli)->isNull

				->object($this->testedInstance->parse([ '-a' ]))->isTestedInstance
				->array($cli)->isEqualTo([ '-a' => [] ])

			->if($cli = null)
			->then
				->object($this->testedInstance->parse([ '-b', '-c' ]))->isTestedInstance
				->array($cli)->isEqualTo([ '-b' => [], '-c' => [] ])

			->if($cli = null)
			->then
				->object($this->testedInstance->parse([ '-b', 'foo', 'bar', '-c' ]))->isTestedInstance
				->array($cli)->isEqualTo([ '-b' => [ 'foo', 'bar' ], '-c' => [] ])


			->if($cli = null)
			->then
				->object($this->testedInstance->parse([ '--d', 'foo', 'bar', '+e', 'foo' ]))->isTestedInstance
				->array($cli)->isEqualTo([ '--d' => [ 'foo', 'bar' ], '+e' => [ 'foo' ] ])
		;
	}
}
