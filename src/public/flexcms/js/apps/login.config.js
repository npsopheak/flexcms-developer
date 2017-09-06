app
    .config(['$interpolateProvider', '$mdThemingProvider',
        function($interpolateProvider, $mdThemingProvider) {
        var neonGreenMap = $mdThemingProvider.extendPalette('red', {
            '500': '#5a8200',
            'contrastDefaultColor': 'dark'
        });

        // Register the new color palette map with the name <code>neonRed</code>
        $mdThemingProvider.definePalette('neonGreen', neonGreenMap);
    	$mdThemingProvider.theme('default')
		    .primaryPalette('neonGreen')
		    .accentPalette('lime');
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

    }]);

app.run(['$http', '$rootScope', '$mdSidenav', '$mdUtil', function ($http, $rootScope, $mdSidenav, $mdUtil){
	
}]);