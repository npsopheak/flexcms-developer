<?php

return [

	'app' => [

		'name' => env('CMS_NAME', 'NEP Documentation Dashboard'),

		'login' => [

			'name' => env('CMS_LOGIN_NAME', 'NEP Documentation'),

			'description' => env('CMS_LOGIN_DESC', 'Accessing the content management system')
			
		],

		'route' => [

			'prefix' => 'dashboard',

			'middleware' => [

				'auth' => ['api.auth'],

				'guest' => ['api.guest']

			],

			'unauthorized' => '/dashboard/login',

			'authorized' => '/dashboard'

		]

	],

	'system' => [

		// Mostly is the app client id or api client id in the nodejs service
		'request_id' => env('CMS_REQUEST_ID', 'X-XX-Request-ID'),

		// The session id 
		'session_id' => env('CMS_SESSION_ID', 'X-XX-ConNEPt-ID'),

		// The key encryption name
		'encrypt_key_id' => env('CMS_ENCRYPT_KEY_ID', 'X-XX-Sign-Key'),

		// User Agent name
		'user_agent' => env('CMS_USER_AGENT', 'NEP Documentation Dashboard')
	],

    'api' => [
    	'endpoint' => env('CMS_ENDPOINT', 'http://localhost:8000/api/v1/'),

		'ws_endpoint' => env('CMS_WS_ENDPOINT', 'http://localhost:8000/api/v1/'),

		'token_property' => env('CMS_TOKEN_PROPERTY', 'access_token'),

		'use_x_forward_for' => false,

		'default_content_type' => 'application/json',

		// Value for request id
		'request_id' => env('CMS_REQUEST_ID_VALUE', 'MGUwMTIwZDEyNmYzZTA4ZDI5ZGFkYzcxZWFmMjhhOGU1MDU3OWNjNzRmZDA1ZWUzZjkyZmU5NTc0OWI1ZjE4Nw==')
    ]

];
