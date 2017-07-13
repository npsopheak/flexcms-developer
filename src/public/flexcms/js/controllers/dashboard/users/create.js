(function(app) {
    app.controller('DashboardUsersCreateCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
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
            $scope.data = CoResource.resources.User
                .get({ id: $scope.id || 'NO_DATA' }, function(s) {
                    $scope.loading = false;


                    $rootScope.loading('hide');
                    if (!s.result) {
                        $scope.mode = 'create';
                        $scope.data = {};

                        $timeout(function() {
                            $rootScope.loading('hide');
                        }, 500);
                    } else {

                        $scope.data = s.result;
                        $scope.mode = 'edit';
                        $scope.data.is_active = $scope.data.is_active ? true : false;

                        $timeout(function() {
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
                    
                    var item = new CoResource.resources.User($scope.data);
                    item.$save(function(s, h) {
                        $scope.data = s.result;
                        $scope.mode = 'edit';
                        $rootScope.loading('hide');
                        if (!hideDialog) {
                            return $mdDialog.show(
                                    $mdDialog.alert()
                                    .parent(angular.element(document.body))
                                    .title('Create User Listing')
                                    .content('User listing is successfully created')
                                    .ariaLabel('Create User Listing')
                                    .ok('Got it!')
                                )
                                .then(function(answer) {
                                    $location.path('accounts/' + $scope.data.id);
                                }, function() {
                                    $location.path('accounts/' + $scope.data.id);
                                });
                        }
                    }, function(f) {
                        $rootScope.loading('hide');
                        if (!hideDialog) {
                            return $mdDialog.show(
                                $mdDialog.alert()
                                .parent(angular.element(document.body))
                                .title('Create User Listing')
                                .content('There was an error while creating User listing. ' + CoResource.textifyError(f.data))
                                .ariaLabel('Create User Listing')
                                .ok('Got it!')
                            );
                        }
                    });

                } else {

                    if ($scope.data.old_password){
                        if (!!$scope.data.password && $scope.data.password !== $scope.data.password_confirmation){
                            $rootScope.loading('hide');
                            return $mdDialog.show(
                                $mdDialog.alert()
                                .parent(angular.element(document.body))
                                .title('Update User Listing')
                                .content('New Password is not matched')
                                .ariaLabel('Update User Listing')
                                .ok('Got it!')
                            );
                        }
                        hideDialog = true;
                    }

                    var item = new CoResource.resources.User.get({
                        id: $scope.data.id
                    }, function() {
                        item = _.extend(item, $scope.data);
                        item = _.omit(item, 'password', 'old_password', 'password_confirmation');

                        if ($rootScope.session.id == $scope.data.id){
                            item = _.omit(item, 'role');
                        }
                        // Update User 
                        item.$update({ id: $scope.data.id }, function(s, h) {

                            $rootScope.loading('hide');
                            if (hideDialog) {
                                return $mdToast.show(
                                    $mdToast.simple()
                                    .content('User updated')
                                    .position($scope.getToastPosition())
                                    .hideDelay(3000)
                                );
                            }
                            return $mdDialog.show(
                                $mdDialog.alert()
                                .parent(angular.element(document.body))
                                .title('Update User Listing')
                                .content('User listing is successfully updated')
                                .ariaLabel('Update User Listing')
                                .ok('Got it!')
                            );
                        }, function(e) {
                            $rootScope.loading('hide');
                            // fail(CoResource.textifyError(e.data));

                            return $mdDialog.show(
                                $mdDialog.alert()
                                .parent(angular.element(document.body))
                                .title('Error Update User Listing')
                                .content(CoResource.textifyError(e.data))
                                .ariaLabel('Update User Listing')
                                .ok('Got it!')
                            );
                        });
                        // Update password changed 
                        if ($scope.data.old_password){
                            CoResource.resources.User.changePassword({
                                id: $scope.data.id
                            }, _.pick($scope.data, 'old_password', 'password', 'password_confirmation'), function (s){
                                $scope.data.old_password = null;
                                $scope.data.password = null;
                                $scope.data.password_confirmation = null;
                                return $mdDialog.show(
                                    $mdDialog.alert()
                                    .parent(angular.element(document.body))
                                    .title('Password Change')
                                    .content('Password Change is successfully updated')
                                    .ariaLabel('Password Change Listing')
                                    .ok('Got it!')
                                );
                            }, function (e){
                                return $mdDialog.show(
                                    $mdDialog.alert()
                                    .parent(angular.element(document.body))
                                    .title('Error Password Change Listing')
                                    .content(e.data.result)
                                    .ariaLabel('Password Change Listing')
                                    .ok('Got it!')
                                );
                            });
                        }
                        

                    }, function(e) {
                        $rootScope.loading('hide');
                        return $mdDialog.show(
                            $mdDialog.alert()
                            .parent(angular.element(document.body))
                            .title('Update User Listing')
                            .content('There was an error while updating User listing. ' + CoResource.textifyError(e.data))
                            .ariaLabel('Update User Listing')
                            .ok('Got it!')
                        );
                    });
                }
            };


            /* START: Update Location listing  */

            // $scope.edit = function($event) {
            //     if ($scope.selected.length == 1) {
            //         $scope.editDimension($scope.selected[0], $event);
            //     }
            // };

            $scope.delete = function($event) {
                if ($scope.data.id) {

                    var confirm = $mdDialog.confirm()
                        .parent(angular.element(document.body))
                        .title('Remove User?')
                        .content('Are sure to remove this User? You cannot undo after you delete it')
                        .ariaLabel('Remove User')
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
                            alert('Sorry, this User cannot be set due to some reason, please contact administrator for more information');
                        });

                    }, function() {});
                }
            };

            // Customized
            // $scope.selected = [];
            // $scope.showDetail = function(ev) {
            //     var item = $scope.selected[0];
            //     $scope.showDialog(item, ev);
            // };

            // $scope.showDialog = function (item, ev){
            //     $mdDialog.show({
            //         controller: 'DashboardCareersCandidateDetailCtrl',
            //         templateUrl: '/partials/dashboard.careers.candidateDetail',
            //         parent: angular.element(document.body),
            //         targetEvent: ev,
            //         locals: {
            //             $current: item
            //         }
            //     })
            //     .then(function(answer) {}, function() {});
            // };


            $(function() {

                $('#pac-input').keydown(function(e) {
                    e.stopPropagation();
                });
            });

    }]);
}(app));