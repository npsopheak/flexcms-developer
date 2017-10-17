(function(app) {
    app.controller('DashboardUsersCreateCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {

	       $scope.person = [
          { id: 30, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
            ];



    }]);
}(app));