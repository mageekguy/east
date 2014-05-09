<?php

call_user_func_array(require(__DIR__ . '/autoloader/autoloader.php'), [
		[
			'jobs\world' =>  __DIR__ . '/world',
			'jobs' =>  __DIR__ . '/classes'
		]
	]
);
