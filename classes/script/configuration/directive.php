<?php

namespace jobs\script\configuration;

use
	jobs\world\configurable,
	jobs\world\configuration
;

class directive implements configuration\directive
{
	private $method = '';
	private $arguments = [];

	function __construct($method, array $arguments = [])
	{
		$this->method = $method;
		$this->arguments = $arguments;
	}

	function execute(configurable $configurable)
	{
		call_user_func_array(array($configurable, $this->method), $this->arguments);

		return $this;
	}
}
