<!DOCTYPE html>
<html lang="{{ $lang=='kh'?'km-kh':'en-us' }}">
	<head>

		{{-- html5 and css3 for ie --}}
	    @include('includes.utility.web-meta')

		{{-- html5 and css3 for ie --}}
	    @include('includes.utility.ie-support')

	</head>

	<body class="no-underline-link no-outline lang_{{ $lang }}" ng-app="app">

		<main itemscope itemtype1="http://schema.org/Organization">
			@yield('content')
		</main>

	</body>


</html>
