<?php

namespace jobs\tests\units;

if (defined('atoum\scripts\runner') === false)
{
	define('atoum\scripts\runner', __FILE__);
}

require_once __DIR__ . '/atoum/scripts/runner.php';

\atoum\autoloader::get()->addDirectory(__NAMESPACE__ . '\asserters', __DIR__ . '/asserters');

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/test.php';
