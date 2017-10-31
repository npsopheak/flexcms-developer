(function(app) {
    app.controller('DashboardUsersCreateCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {
            $scope.isUsageOrderImagesChanged = false;
            
	       $scope.person = [
            { id: 30, name:"/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg" },{ id: 31, name:"/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg" },{ id: 32, name:"/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg" },{ id: 33, name:"/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg" },{ id: 34, name:"/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg" },{ id: 35, name:"/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg" },
            ];
            $scope.sortableOptions = {
                containment: '#sortable-container',
                orderChanged: function(event) {
                    // console.log(event);
                    // console.log("data.banner", $scope.data.banner);
                    $scope.isUsageOrderImagesChanged=true;
                    // console.log("$scope.isUsageOrderImagesChanged",$scope.isUsageOrderImagesChanged);
                }
            };



    }]);
}(app));