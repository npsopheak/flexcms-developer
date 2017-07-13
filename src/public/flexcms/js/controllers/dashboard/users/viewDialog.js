(function (app) {
    app.controller('DashboardUsersViewDialogCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', '$current', function ($scope, $timeout, $mdSidenav,
            $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
            $mdToast, CoResource, filterFilter, $current) {

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

            // Load resource staff type
            CoResource.resources.Item.list({
                type: 'directory_user'
            }, function (s) {
                $scope.types = s.result;
            });

            // Edit the save

            $scope.save = function ($event) {

                var success = function () {
                    $current = $scope.data;
                    $rootScope.$emit('dataDirectoryUserSaved', {
                        mode: $current ? 'edit' : 'create',
                        $current: $current
                    });
                    return $mdDialog.show(
                        $mdDialog.alert({
                            preserveScope: true,
                            autoWrap: true,
                            skipHide: true,
                            title: 'Add User info',
                            content: 'User info has been saved',
                            ariaLabel: 'Add User info',
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
                            title: 'Add User info',
                            content: 'There was an error while saving User. ' + f,
                            ariaLabel: 'Add User info',
                            ok: 'Got it!'
                        })
                    );
                };
                $rootScope.loading('show');

                if ($scope.data.id) {

                    CoResource.resources.MemberUser.update({
                        id: $scope.data.directory_id,
                        userId: $scope.data.id
                    }, $scope.data, function (s, h) {
                        success();
                        $rootScope.loading('hide');
                    }, function (e) {
                        $rootScope.loading('hide');
                        fail(CoResource.textifyError(e.data));
                    });
                }
                else {
                    var item = new CoResource.resources.MemberUser($scope.data);
                    item.$save({
                        id: $scope.data.directory_id
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