<?php

namespace jobs\world\configuration;

use
	jobs\world\configurable
;

interface directive
{
	function execute(configurable $configurable);
}
