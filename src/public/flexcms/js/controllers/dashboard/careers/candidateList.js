(function(app) {
    app.controller('DashboardCareersCandidateListCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {

            $scope.data = [];
            $scope.selected = [];

            $scope.search = {
                query: $location.search().search || ''
            };

            // $scope.view = function() {
            //     var item = $scope.selected[0];
            //     $location.path('careers/' + item.id);
            // };

            // $scope.create = function() {
            //     $location.path('careers/create');
            // };


            // Pagination
            $scope.pagination = {
                limit: 15,
                offset: $location.search().offset || 1,
                current: 1
            };

            $scope.changePage = function(current) {
                $scope.pagination.current = current;
            };

            $scope.preparePagination = function() {
                var amount = $scope.pagination.total_record > $scope.pagination.limit ? Math.round($scope.pagination.total_record / $scope.pagination.limit) : 0;

                $scope.pagination.total = _.map(new Array(amount), function(value, key) {
                    return key + 1;
                });
            };

            $scope.changeOffset = function(offset) {
                $scope.pagination.offset = offset;
            };

            function loadData(callback, offset, limit) {
                offset = offset || $scope.pagination.offset;
                limit = limit || 10;

                CoResource.resources.Career.listCandidate({
                    'offset': (offset - 1) * limit || 0,
                    'limit': limit || 10,
                    'ignore-offset': 0,
                    'search': $scope.search.query || '',
                    'sort': 'name', // $scope.sort || '',
                    // 'scope': 'foods,origins,categories,features,menu,drinks,payment_methods,parkings',
                }, function(s) {
                    $scope.data = s.result;
                    $scope.pagination.total_record = s.options.total;
                    $scope.preparePagination();
                    setTimeout(function() {
                        // renderMagnific();
                    }, 2000);

                    if (callback) {
                        callback();
                    }
                });
            }

            loadData();

            $scope.onPageChanged = function() {
                $location.search('offset', $scope.pagination.offset);
            };

            $scope.sort = '';
            $scope.changeSort = function() {
                if ($scope.sort == '') {
                    $scope.sort = 'desc';
                } else if ($scope.sort == 'desc') {
                    $scope.sort = 'asc';
                } else {
                    $scope.sort = '';
                }

                $rootScope.loading('show');
                loadData(function() {
                    $rootScope.loading('hide');
                });

            };

            $scope.$watch('search.query', function(v, old) {
                if (v == old) {
                    return;
                }
                // $rootScope.loading('show');

                // loadData(function (){
                // 	$rootScope.loading('hide');
                // });
                $location.search('search', v);
            });

            var timer = null;

            function startCalling() {
                if (timer) {
                    $timeout.cancel(timer);
                }
                timer = $timeout(function() {

                    $rootScope.loading('show');

                    loadData(function() {
                        $rootScope.loading('hide');
                    });
                }, 700);

            }

            /* EVENT WATCHERS */

            var watchers = {};
            watchers['search'] = $scope.$watch(function() {
                return $location.search().search;
            }, function(v, old) {

                if (v == old) {
                    return;
                }

                $scope.search.query = v;
                startCalling();
            });

            watchers['offset'] = $scope.$watch(function() {
                return $location.search().offset;
            }, function(v, old) {

                if (v == old) {
                    return;
                }

                $scope.pagination.offset = v;
                startCalling();
            });

            $scope.$on('$destroy', function() {
                for (var key in watchers) {
                    watchers[key]();
                }
                $location.search('offset', null);
                $location.search('search', null);
            });

            // Remove function 

            // $scope.removeDialog = function(item, ev) {
            //     if (item) {

            //         var confirm = $mdDialog.confirm()
            //             .parent(angular.element(document.body))
            //             .title('Remove job?')
            //             .content('Are sure to remove this job info? You cannot undo after you delete it')
            //             .ariaLabel('Remove job')
            //             .ok('Yes')
            //             .cancel('No')
            //             .targetEvent(ev);
            //         $mdDialog.show(confirm).then(function() {
            //             $rootScope.loading('show');
            //             var query = {
            //                 id: $scope.data.id,
            //             };
            //             query['id'] = item.id;
            //             CoResource.resources.Career.delete(query, {}, function(s) {
            //                 loadData();
            //                 $rootScope.loading('hide');
            //             }, function(e) {
            //                 $rootScope.loading('hide');
            //                 alert('Sorry, this item cannot be set due to some reason, please contact administrator for more information');
            //             });

            //         }, function() {});
            //     }
            // };

            // // Customized
            // $scope.selected = [];
            // $scope.remove = function(ev) {
            //     var item = $scope.selected[0];
            //     $scope.removeDialog(item, ev);
            // };
	    

    }]);
}(app));