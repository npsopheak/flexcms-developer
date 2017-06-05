<?php

return [

	'app' => [

		'name' => 'Flex Dashboard',

		'login' => [

			'name' => 'Flex Dashboard',

			'description' => 'Accessing the content management system'
			
		]

	],

	'system' => [

		// Mostly is the app client id or api client id in the nodejs service
		'request_id' => 'X-XX-Request-ID',

		// The session id 
		'session_id' => 'X-XX-Connect-ID',

		// The key encryption name
		'encrypt_key_id' => 'X-XX-Sign-Key',

		// User Agent name
		'user_agent' => 'Flex Dashboard'
	],

    'api' => [
    	'endpoint' => 'http://localhost:8000/api/v1/',

		'ws_endpoint' => 'http://localhost:8000/api/v1/',

		'use_x_forward_for' => false,

		'default_content_type' => 'application/json',

		// Value for request id
		'request_id' => 'MGUwMTIwZDEyNmYzZTA4ZDI5ZGFkYzcxZWFmMjhhOGU1MDU3OWNjNzRmZDA1ZWUzZjkyZmU5NTc0OWI1ZjE4Nw=='
    ],

	'cms' => [
		'modules' => [
			// Main for module dashboard such as: dashboard/activities,
			// Main for customs such as: customs/controllers/left, customs/services/crypt
			'excepts' => ['dashboard/activities', 'dashboard/budgets', 'dashboard/contacts', 'dashboard/donors', 'dashboard/members',
			'dashboard/staffs']
		]
	]

];
