(function(app) {
    app.controller('LeftCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {

	    $scope.close = function () {
            $mdSidenav('left').close()
                .then(function () {
                    $log.debug("close LEFT is done");
                });
        };	
        console.log(namespace.menus);
        $scope.menus = namespace.menus;

        $scope.logout = function (ev){
            var confirm = $mdDialog.confirm()
                .parent(angular.element(document.body))
                .title('Sign out')
                .content('Are sure to signout from this dashboard?')
                .ariaLabel('Sign out')
                .ok('Yes')
                .cancel('No')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                window.location = '/dashboard/signout';
            }, function() {
            });		
        };

    }]);
}(app));