(function (app) {
    app.controller('DashboardContactsViewDialogCtrl', ['$scope', '$timeout', '$mdSidenav',
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
                type: 'directory_position'
            }, function (s) {
                $scope.positions = s.result;
            });

            // Edit the save

            $scope.save = function ($event) {

                var success = function () {
                    $current = $scope.data;
                    $rootScope.$emit('dataDirectoryContactSaved', {
                        mode: $current ? 'edit' : 'create',
                        $current: $current
                    });
                    return $mdDialog.show(
                        $mdDialog.alert({
                            preserveScope: true,
                            autoWrap: true,
                            skipHide: true,
                            title: 'Add Contact info',
                            content: 'Contact info has been saved',
                            ariaLabel: 'Add Contact info',
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
                            title: 'Add Contact info',
                            content: 'There was an error while saving Contact. ' + f,
                            ariaLabel: 'Add Contact info',
                            ok: 'Got it!'
                        })
                    );
                };
                $rootScope.loading('show');

                if ($scope.data.id) {

                    CoResource.resources.MemberContact.update({
                        id: $scope.data.directory_id,
                        contactId: $scope.data.id
                    }, $scope.data, function (s, h) {
                        success();
                        $rootScope.loading('hide');
                    }, function (e) {
                        $rootScope.loading('hide');
                        fail(CoResource.textifyError(e.data));
                    });
                }
                else {
                    var item = new CoResource.resources.MemberContact($scope.data);
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