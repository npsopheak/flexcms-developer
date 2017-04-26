(function(app) {
    app.controller('LoginCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, MockService, $mdDialog, $location,
        $mdToast, CoResource, filterFilter) {

		$scope.submit = function ($event){
            if (!$scope.user || !$scope.user.email || !$scope.user.password){
                return;
            }
			$('#page-login')[0].submit();
		};	    

    }]);
}(app));