<!DOCTYPE html>
<html lang="en" ng-app="StarterApp">
	<head>
		<meta charset ="utf-8" />
		<title>{{ config('flexcms.app.name') }} - CoCMS</title>
		<!-- <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0"> -->
		<meta name="description" content="CoCMS"/>
		<meta name="keywords" content="web, system, cms, coding"/>
		<meta name="author" content="nexGenDev"/>
		<meta name="developers" content="nexGenDev"/>
		<meta name="developer" content="nexGenDev"/>
		<meta name="contact" content="biz@flexitech.io"/>

		<link href="/img/favico.gif" type="image/x-icon" rel="shortcut icon" />
		<link href="{{ asset('vendors/angular-material/angular-material.min.css') }}" rel="stylesheet">		
		<link href="{{ asset('css/main.css') }}" rel="stylesheet">	
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=RobotoDraft:300,400,500,700,400italic">
	    <meta name="viewport" content="initial-scale=1" />
	</head>
	<body layout="column" layout-align="center center"
		fake-style="background-image: url(/img/bg/home-background.jpg);background-size: cover;"
        style="background-color: rgba(111, 111, 111, 0.14);"> 
		@yield('content')
	</body>

    {{-- Generate script --}}
    {!! \CMS::generateScripts('global') !!}

    {!! \CMS::generateScripts('login') !!}

    {!! \CMS::generateScripts('customs', ['services/crypt', 'services/resource', 'services/request', 'controllers/loading', 'controllers/alert']) !!}

	
</html>