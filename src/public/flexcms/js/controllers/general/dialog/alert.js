(function() {
    app.controller('GeneralDialogAlertCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', '$current', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, MockService, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter, $current) {

	    $scope.data = {};

	 	$scope.data = $current ? angular.copy($current) : null;

	 	$scope.close = function (){
	 		$mdDialog.hide();
	 	};

    }]);
}());
