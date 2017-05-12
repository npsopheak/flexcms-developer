(function(app) {
    app.controller('DashboardItemsViewDialogCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', '$current', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter, $current) {
                
            $scope.item_types = {
                'directory_category': 'NGO Type',
                'directory_staff': 'Staff Type',
                'directory_position': 'Staff Position',
                'directory_library': 'Document Type',
                'directory_project_type': 'Project Type',
                'directory_location': 'Location'
            };

            $scope.onDisplayNameChange = function (){
                if ($scope.data.display_name){
                    $scope.data.name = namespace.urlify($scope.data.display_name) + (new Date().getTime());
                }
                else{
                    $scope.data.name = '';
                }
            };

            $scope.data = $current ? angular.copy($current) : null;

            $scope.toastPosition = {
                bottom: false,
                top: true,
                left: false,
                right: true
            };

            $scope.mode = $scope.data && !!$scope.data.id ? 'edit' : 'create';

            $scope.getToastPosition = function () {
                return Object.keys($scope.toastPosition)
                    .filter(function (pos) { return $scope.toastPosition[pos]; })
                    .join(' ');
            };

            $scope.close = function () {
                $mdDialog.hide();
            };
            
            // Edit the save

            $scope.save = function ($event) {

                var success = function () {
                    $current = $scope.data;
                    $rootScope.$emit('dataDirectoryItemSaved', {
                        mode: $current ? 'edit' : 'create',
                        $current: $current
                    });
                    return $mdDialog.show(
                        $mdDialog.alert({
                            preserveScope: true,
                            autoWrap: true,
                            skipHide: true,
                            title: 'Add Item info',
                            content: 'Item info has been saved',
                            ariaLabel: 'Add Item info',
                            ok: 'Got it!'
                        })
                    )
                        .finally(function () {
                            $mdDialog.hide();
                        });
                };

                var fail = function (f) {
                    return $mdDialog.show(
                        $mdDialog.alert({
                            preserveScope: true,
                            autoWrap: true,
                            skipHide: true,
                            // parent: angular.element(document.body),
                            title: 'Add Item info',
                            content: 'There was an error while saving Item. ' + f,
                            ariaLabel: 'Add Item info',
                            ok: 'Got it!'
                        })
                    );
                };
                $rootScope.loading('show');

                if ($scope.data.id){

                    CoResource.resources.Item.update({ 
                        itemId: $scope.data.id 
                    }, $scope.data, function (s, h) {
                        success();
                        $rootScope.loading('hide');
                    }, function (e) {
                        $rootScope.loading('hide');
                        fail(CoResource.textifyError(e.data));
                    });
                }
                else{
                    $scope.data.status = 'active';
                    var item = new CoResource.resources.Item($scope.data);
                    item.$save({
                        
                    }, function (s, h) {
                        success();
                        $rootScope.loading('hide');
                    }, function (e) {
                        $rootScope.loading('hide');
                        fail(CoResource.textifyError(e.data));
                    });
                }
            };


    }]);
}(app));