<!DOCTYPE html>
<html lang="{{ $lang=='kh'?'km-kh':'en-us' }}">
	<head>

		{{-- html5 and css3 for ie --}}
	    @include('includes.utility.web-meta')

		{{-- html5 and css3 for ie --}}
	    @include('includes.utility.ie-support')
  
	    <link href="https://fonts.googleapis.com/css?family=Hanuman|Roboto+Condensed:400" rel="stylesheet" type="text/css">

	    @if(App::environment('local'))
			<link href="{{ asset('css/vendors.css') }}" rel="stylesheet">
			<link href="{{ asset('css/style.css') }}" rel="stylesheet">
			<link href="{{ elixir('fonts/icomoon-front/style.css') }}" rel="stylesheet">	
			<link href="{{ elixir('vendors/flickity/dist/flickity.min.css') }}" rel="stylesheet">	
			<link href="{{ asset('vendors/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet">	
		@else
			<link href="{{ elixir('css/vendors_mix.css') }}" rel="stylesheet">
			<link href="{{ elixir('css/style.css') }}" rel="stylesheet">	
			{{-- <link href="{{ elixir('fonts/icomoon-front/style.css') }}" rel="stylesheet">	 --}}
		@endif

	</head>

	<body class="no-underline-link no-outline lang_{{ $lang }}" ng-app="app">

		<header>
			@if(isset($onMapSearch))
				@include("includes.layouts.simple-nav-bar", array('full_width'=>true))
			@else
				@include("includes.layouts.simple-nav-bar")
			@endif

		</header>

		<main itemscope itemtype1="http://schema.org/Organization">
			@yield('content')
		</main>

		@if(!isset($onMapSearch)) 
			<footer>
				@include("includes.layouts.simple-footer")
			</footer>
		@endif

		<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCrP9rxOqS4yAxtd-3cT9kJTYnO5fpnJoY'></script>

		@if(App::environment('local'))

			

			<script type="text/javascript" src="{{ asset('vendors/jquery/dist/jquery.js') }}"></script>

			<script type="text/javascript" src="{{ asset('vendors/angular/angular.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/angular-route/angular-route.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/angular-messages/angular-messages.min.js') }}"></script>

			<script type="text/javascript" src="{{ asset('vendors/angular-facebook/lib/angular-facebook.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/underscore/underscore-min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/magnific-popup/dist/jquery.magnific-popup.js') }}"></script>

			<script type="text/javascript" src="{{ asset('vendors/ng-file-upload/ng-file-upload.min.js') }}"></script>
			
			<script type="text/javascript" src="{{ asset('vendors/angular-google-maps/dist/angular-google-maps.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/lodash/dist/lodash.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/angular-simple-logger/dist/angular-simple-logger.min.js') }}"></script>

			<script type="text/javascript" src="{{ asset('vendors-download/ui-bootstrap/ui-bootstrap-custom-2.2.0.js') }}"></script>
			
			<script type="text/javascript" src="{{ asset('vendors/flickity/dist/flickity.pkgd.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/flickity-bg-lazyload/bg-lazyload.js') }}"></script>
			
			<script type="text/javascript" src="{{ asset('vendors/tether/dist/js/tether.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('vendors/angular-contenteditable/angular-contenteditable.js') }}"></script>
			
			<script type="text/javascript" src="{{ asset('vendors/xregexp/xregexp-all.js') }}"></script>

			<script type="text/javascript" src="{{ asset('js/directives/finished-render.js') }}"></script>

			<script type="text/javascript" src="{{ asset('js/hh/app.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/hh/user_view.js') }}"></script>

			<script type="text/javascript" src="{{ asset('js/libraries/crypt/aes.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/libraries/crypt/pbkdf2.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/libraries/jsencrypt.js') }}"></script>

			<script type="text/javascript" src="{{ asset('js/services/crypt.js') }}"></script>

			<script type="text/javascript" src="{{ asset('js/services/request.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/services/genfunc.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/services/hhModule.js') }}"></script>

			<script type="text/javascript" src="{{ asset('js/hh/rest-map.js') }}"></script>
			

		@else

			<script type="text/javascript" src="{{ elixir('js/build/hh-script.js') }}"  async="true"></script>

		@endif

		<script>
		
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-61935322-6', 'auto');
			ga('send', 'pageview');

		</script>

	   @section('scripts')
	      
	  	@show

	</body>

	
</html>