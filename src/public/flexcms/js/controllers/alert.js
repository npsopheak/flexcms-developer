(function(app) {
    app.controller('AlertCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {

	    
	    $scope.data = {};

	 	$scope.data = $current ? angular.copy($current) : null;

	 	$scope.close = function (){
	 		$mdDialog.hide();
	 	};

    }]);
}(app));