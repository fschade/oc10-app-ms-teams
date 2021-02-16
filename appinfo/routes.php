<?php

// @codeCoverageIgnoreStart
return [
	'routes' => [
		['name' => 'authentication#index', 'url' => '/', 'verb' => 'GET'],
		['name' => 'authentication#finalize', 'url' => '/finalize', 'verb' => 'GET'],
		['name' => 'authentication#login', 'url' => '/redirect', 'verb' => 'GET'],
		['name' => 'factory#build', 'url' => '/factory/build', 'verb' => 'GET'],
	]
];
