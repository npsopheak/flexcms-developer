<!DOCTYPE html>
<html lang="en" ng-app="StarterApp">
	<head>
		<meta charset ="utf-8" />
        <meta name="viewport" content="initial-scale=1" />
		<title>{{ config('flexcms.app.name') }} - CoCMS</title>
		<!-- <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0"> -->
		<meta name="description" content="CoCMS"/>
		<meta name="keywords" content="web, system, cms, coding"/>
		<meta name="author" content="nexGenDev"/>
		<meta name="developers" content="nexGenDev"/>
		<meta name="developer" content="nexGenDev"/>
		<meta name="contact" content="biz@flexitech.io"/>

        @if (FlexAuth::isLogin('user'))
            <meta name="api:bearer" content="{{ FlexAuth::getProperty(config('flexcms.api.token_property'), 'user') }}">
            <meta name="api:request" content="{{ config('flexcms.api.request_id') }}">
        @endif

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=RobotoDraft:300,400,500,700,400italic">
        
		<link href="{{ URL::asset('img/red.png') }}" type="image/x-icon" rel="shortcut icon" />


        @if (App::environment('local'))

            <link href="{{ asset('vendor/flexcms/css/vendor.css') }}" rel="stylesheet">
            <!-- <link href="{{ asset('vendor/flexcms/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet"> -->
            
            <link href="{{ asset('vendor/flexcms/vendors/angular-material/angular-material.min.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/vendors/angular-material-datetimepicker/dist/material-datetimepicker.min.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/vendors/angular-material-data-table/dist/md-data-table.min.css') }}" rel="stylesheet" type="text/css"/>
            <link href="{{ asset('vendor/flexcms/css/main.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/css/coreuistyle.css') }}" rel="stylesheet">    
            <link href="{{ asset('vendor/flexcms/vendors/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/vendors/selectize/dist/css/selectize.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/vendors/ng-sortable/dist/ng-sortable.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/vendors/ng-sortable/dist/ng-sortable.style.min.css') }}" rel="stylesheet">

        @else
            <link href="{{ asset('vendor/flexcms/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet">
            
            <link href="{{ asset('vendor/flexcms/vendors/angular-material/angular-material.min.css') }}" rel="stylesheet">
            <link href="{{ asset('vendor/flexcms/vendors/angular-material-datetimepicker/dist/material-datetimepicker.min.css') }}" rel="stylesheet">
            <!-- <link href="{{ asset('vendor/flexcms/vendors/angular-material-data-table/dist/md-data-table.min.css') }}" rel="stylesheet" type="text/css"/> -->
            <link href="{{ asset('vendor/flexcms/css/coreuistyle.css') }}" rel="stylesheet">    
            
            <link href="{{ elixir('/vendor/build/css/admin_style.css') }}" rel="stylesheet">

        @endif


	    <style>
	        .datepicker.datepicker-inline{
	            margin: auto;
	        }
	    </style>
	</head>
	<body layout="column" class="ng-cloak app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
        <main itemscope itemtype1="http://schema.org/Organization">
            <div class="app-header navbar">
                @include ('flexcms::includes.layouts.header')
            </div>
            <div class="app-body">
                <div class="sidebar">
                    @include ('flexcms::includes.layouts.dashboard-sidebar')
                </div>
                <div class="main" style="min-height: 100vh;">
                    @include ('flexcms::includes.layouts.topMenuContent')
                    @yield('content')
                </div>
                <div class="aside-menu">
                    @include ('flexcms::includes.layouts.asidebar')
                </div>
                   
            </div >
            <div class="app-footer">
                @include ('flexcms::includes.layouts.footer')
            </div>
            
        </main>
	</body>

    <script src='//maps.googleapis.com/maps/api/js?key=AIzaSyCrP9rxOqS4yAxtd-3cT9kJTYnO5fpnJoY&libraries=places'></script>


    @if (App::environment('local')) 

        <script src="/vendor/flexcms/vendors/moment/min/moment.min.js"></script>
        <script src="/vendor/flexcms/vendors/lodash/dist/lodash.min.js"></script>

        {!! \CMS::generateScripts('global') !!}

        <script type="text/javascript">
            // CONFIGURE DOMAIN
            namespace.domain = '{{ config("flexcms.api.endpoint") }}';
            namespace.sessionId = '{{ config("flexcms.api.session_id") }}';
        </script>


        <script src="/vendor/flexcms/vendors-download/magnific-popup/jquery.magnific-popup.js"></script>
        <script src="/vendor/flexcms/vendors/angular-google-maps/dist/angular-google-maps.min.js"></script>
        <script src="/vendor/flexcms/vendors/angular-material-datetimepicker/dist/angular-material-datetimepicker.min.js"></script>
        <script type="text/javascript" src="{{ asset('/vendor/flexcms/vendors/angular-simple-logger/dist/angular-simple-logger.min.js') }}"></script>
        <script src="/vendor/flexcms/vendors/ngmap/build/scripts/ng-map.min.js"></script>
        <script src="/vendor/flexcms/vendors/angular-resource/angular-resource.min.js"></script>
        <script src="/vendor/flexcms/vendors/angular-drag-and-drop-lists/angular-drag-and-drop-lists.min.js"></script>
        <script src="/vendor/flexcms/vendors/angular-aria/angular-aria.min.js"></script>
        <script src="/vendor/flexcms/vendors/angular-material/angular-material.min.js"></script>
        <script src="/vendor/flexcms/vendors/angular-route/angular-route.min.js"></script>
        <script src="/vendor/flexcms/vendors/angular-sanitize/angular-sanitize.min.js"></script>
        <script src="/vendor/flexcms/vendors/ng-file-upload/ng-file-upload.min.js"></script>

        <script src="/vendor/flexcms/vendors/material-angular-paging/build/dist.min.js"></script>
        <script src="/vendor/flexcms/vendors/ng-file-upload-shim/ng-file-upload-shim.min.js"></script>
        <script type="text/javascript" src="/vendor/flexcms/vendors-download/popper.min.js"></script>
        
        <!-- <script type="text/javascript" src="/vendor/flexcms/vendors/angular-material-data-table/dist/md-data-table.min.js"></script> -->
        <script type="text/javascript" src="/vendor/flexcms/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/vendor/flexcms/vendors/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="/vendor/flexcms/vendors/sifter/sifter.js"></script>
        <script type="text/javascript" src="/vendor/flexcms/vendors/microplugin/src/microplugin.js"></script>
        <script type="text/javascript" src="/vendor/flexcms/vendors/selectize/dist/js/selectize.min.js"></script>
        <script type="text/javascript" src="/vendor/flexcms/vendors/angular-selectize2/dist/angular-selectize.js"></script>
        <script type="text/javascript" src="/vendor/flexcms/js/js123/app.js"></script>
        <!-- <script type="text/javascript" src="/vendor/flexcms/js/js123/hook.js"></script> -->
        <script type="text/javascript" src="/vendor/flexcms/vendors/ng-sortable/dist/ng-sortable.min.js"></script>

        <!-- Text editor -->
        <!-- <script src="/vendor/flexcms/vendors-download/ckeditor/ckeditor.js"></script> -->
        <!-- App -->

        {!! \CMS::generateScripts('customs', ['util/menu', 'util/endpoint', 'util/route']) !!}
        
        {!! \CMS::generateScripts('dashboard') !!}

        {!! \CMS::generateScripts('customs', [ 'directives/coEditor', 
            'services/crypt', 'services/resource', 'services/request', 
            'controllers/loading', 'controllers/alert', 'controllers/left']) !!}
    
    @else

        <script src="{{ elixir('/vendor/build/js/hh-admin-script.js') }}"></script>

        <script type="text/javascript">
            // CONFIGURE DOMAIN
            namespace.domain = '{{ config("flexcms.api.endpoint") }}';
            namespace.sessionId = '{{ config("flexcms.api.session_id") }}';
        </script>

    @endif

    @section('scripts')

  	@show

</html>
