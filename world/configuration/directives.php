<?php

namespace jobs\world\configuration;

use
	jobs\world\configurable
;

interface directives
{
	public function addDirective(directive $directive);
	public function containsDirective(directive $directive);
	public function execute(configurable $configurable);
}
