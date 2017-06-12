(function(app) {
    app.controller('DashboardCareersCreateCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter',
        function($scope, $timeout, $mdSidenav,
            $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
            $mdToast, CoResource, filterFilter) {

            $scope.id = $routeParams.id;
            $scope.toastPosition = {
                bottom: false,
                top: true,
                left: false,
                right: true
            };

            $scope.getToastPosition = function() {
                return Object.keys($scope.toastPosition)
                    .filter(function(pos) { return $scope.toastPosition[pos]; })
                    .join(' ');
            };
            // Get data
            $rootScope.loading('show');
            $scope.loading = true;
            $scope.selected = [];
            $scope.data = {};
            $scope.mode = 'create';

            // Load data 
            $scope.data = CoResource.resources.Career
                .get({ id: $scope.id || 'NO_DATA' }, function(s) {
                    $scope.loading = false;


                    $rootScope.loading('hide');
                    if (!s.result) {
                        $scope.mode = 'create';
                        $scope.data = {};

                        $timeout(function() {
                            $('#requirement-editor').val('');
                            $('#res-editor').val('');
                            $rootScope.loading('hide');
                        }, 500);
                    } else {

                        $scope.data = $scope.data.result;
                        $scope.mode = 'edit';
                        $scope.data.is_active = $scope.data.is_active ? true : false;

                        $timeout(function() {
                            // $('#res-editor').val($scope.da`ta.responsibility);
                            // $('#requirement-editor').val(`$scope.data.requirement);
                            $rootScope.loading('hide');
                        }, 1000);

                    }
                }, function(f) {
                    $scope.loading = false;
                    $rootScope.loading('hide');
                });

            // Save data
            $scope.submit = function(hideDialog) {

                $rootScope.loading('show');

                if ($scope.mode === 'create') {
                    // $scope.data.hash = $scope.hash;

                    var item = new CoResource.resources.Career($scope.data);
                    item.$save(function(s, h) {
                        $scope.data = s.result;
                        $scope.mode = 'edit';
                        $rootScope.loading('hide');
                        if (!hideDialog) {
                            return $mdDialog.show(
                                    $mdDialog.alert()
                                    .parent(angular.element(document.body))
                                    .title('Create Career Job Listing')
                                    .content('Career Job listing is successfully created')
                                    .ariaLabel('Create Career Job Listing')
                                    .ok('Got it!')
                                )
                                .then(function(answer) {
                                    $location.path('careers/' + $scope.data.id);
                                }, function() {
                                    $location.path('careers/' + $scope.data.id);
                                });
                        }
                    }, function(f) {
                        $rootScope.loading('hide');
                        if (!hideDialog) {
                            return $mdDialog.show(
                                $mdDialog.alert()
                                .parent(angular.element(document.body))
                                .title('Create Career Job Listing')
                                .content('There was an error while creating Career Job listing. ' + CoResource.textifyError(f.data))
                                .ariaLabel('Create Career Job Listing')
                                .ok('Got it!')
                            );
                        }
                    });

                } else {

                    var item = new CoResource.resources.Career.get({
                        id: $scope.data.id
                    }, function() {
                        item = _.extend(item, $scope.data);
                        item.$update({ id: $scope.data.id }, function(s, h) {

                            $rootScope.loading('hide');
                            if (hideDialog) {
                                return $mdToast.show(
                                    $mdToast.simple()
                                    .content('Map updated')
                                    .position($scope.getToastPosition())
                                    .hideDelay(3000)
                                );
                            }
                            return $mdDialog.show(
                                $mdDialog.alert()
                                .parent(angular.element(document.body))
                                .title('Update Career Job Listing')
                                .content('Career Job listing is successfully updated')
                                .ariaLabel('Update Career Job Listing')
                                .ok('Got it!')
                            );
                        }, function(e) {
                            $rootScope.loading('hide');
                            // fail(CoResource.textifyError(e.data));

                            return $mdDialog.show(
                                $mdDialog.alert()
                                .parent(angular.element(document.body))
                                .title('Error Update Career Job Listing')
                                .content(CoResource.textifyError(e.data))
                                .ariaLabel('Update Career Job Listing')
                                .ok('Got it!')
                            );
                        });
                    }, function(e) {
                        $rootScope.loading('hide');
                        return $mdDialog.show(
                            $mdDialog.alert()
                            .parent(angular.element(document.body))
                            .title('Update Career Job Listing')
                            .content('There was an error while updating Career Job listing. ' + CoResource.textifyError(e.data))
                            .ariaLabel('Update Career Job Listing')
                            .ok('Got it!')
                        );
                    });
                }
            };


            /* START: Update Location listing  */

            $scope.edit = function($event) {
                if ($scope.selected.length == 1) {
                    $scope.editDimension($scope.selected[0], $event);
                }
            };

            $scope.delete = function($event) {
                if ($scope.data.id) {

                    var confirm = $mdDialog.confirm()
                        .parent(angular.element(document.body))
                        .title('Remove Career Job?')
                        .content('Are sure to remove this Career Job? You cannot undo after you delete it')
                        .ariaLabel('Remove Career Job')
                        .ok('Yes')
                        .cancel('No')
                        .targetEvent($event);
                    $mdDialog.show(confirm).then(function() {
                        $rootScope.loading('show');
                        CoResource.resources.Member.delete({
                            id: $scope.data.id
                        }, {}, function(s) {
                            $rootScope.loading('hide');
                            $location.path('/');
                        }, function(e) {
                            $rootScope.loading('hide');
                            alert('Sorry, this Career Job cannot be set due to some reason, please contact administrator for more information');
                        });

                    }, function() {});
                }
            };


            $(function() {

                $('#pac-input').keydown(function(e) {
                    e.stopPropagation();
                });
            });

        }
    ]);
}(app));