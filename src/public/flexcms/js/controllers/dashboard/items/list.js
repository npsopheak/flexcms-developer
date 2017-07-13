(function(app) {
    app.controller('DashboardItemsListCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {

	    
	    $scope.data = [];
        $scope.selected = [];
        $scope.item_types = {
            'directory_category': 'NGO Type',
            'directory_staff': 'Staff Type',
            'directory_position': 'Staff Position',
            'directory_library': 'Document Type',
            'directory_project_type': 'Project Type',
            'directory_location': 'Location'
        };

		$scope.search = {
			query: $location.search().search || '',
            type: $location.search().type || '',
		};

		// $scope.view = function(){
		// 	var item = $scope.selected[0];
		// 	$location.path('items/' + item.id);
		// };	

		// $scope.create = function(){
		// 	$location.path('members/create');
		// };	

		
	    // Pagination
	    $scope.pagination = {
	    	limit: 15,
	    	offset: $location.search().offset || 1,
	    	current: 1
	    };

	    $scope.changePage = function(current){
	    	$scope.pagination.current = current;
	    };

	    $scope.preparePagination = function (){	    	
		    var amount = $scope.pagination.total_record > $scope.pagination.limit ? Math.round($scope.pagination.total_record / $scope.pagination.limit) : 0;

		    $scope.pagination.total = _.map(new Array(amount), function (value, key){
		    	return key + 1;
		    });
	    };

	    $scope.changeOffset = function (offset){
	    	$scope.pagination.offset = offset;
	    };

	    function loadData(callback, offset, limit){
	    	offset = offset || $scope.pagination.offset;
	    	limit = limit || 10;
	    	
			CoResource.resources.Item.list({
				'offset': (offset - 1) * limit || 0,
				'limit': limit || 10,
		    	'ignore-offset': 0,
                'type': $scope.search.type ? $scope.search.type : _.map($scope.item_types, function (v, k){ return k; }).join(','),
		    	// 'search': $scope.search.query || '',
		    	'sort': 'display_name', // $scope.sort || '',
		    	// 'scope': 'foods,origins,categories,features,menu,drinks,payment_methods,parkings',
		    }, function(s) {
		    	$scope.data = s.result;
		    	$scope.pagination.total_record = s.options.total;
		    	$scope.preparePagination();
		    	setTimeout(function (){
		    		// renderMagnific();
		    	}, 2000);

		    	if (callback){
		    		callback();
		    	}
		    });
	    }

	    loadData();
        

	    $scope.onPageChanged = function (){
	    	$location.search('offset', $scope.pagination.offset);
	    };

		$scope.sort = '';
	    $scope.changeSort = function (){
	    	if ($scope.sort == ''){
	    		$scope.sort = 'desc';
	    	}
	    	else if ($scope.sort == 'desc'){
	    		$scope.sort = 'asc';
	    	}
	    	else{
	    		$scope.sort = '';
	    	}

	    	$rootScope.loading('show');
	    	loadData(function (){
		    	$rootScope.loading('hide');
	    	});

	    };

	    $scope.$watch('search.query', function (v, old){	
			if (v == old){
				return;
			}    	
	    	// $rootScope.loading('show');

	    	// loadData(function (){
		    // 	$rootScope.loading('hide');
	    	// });
	    	$location.search('search', v);
	    });

	    $scope.$watch('search.type', function (v, old){	
			if (v == old){
				return;
			}    	
	    	$location.search('type', v);
	    });

	    var timer = null;
	    function startCalling(){
	    	if (timer){
	    		$timeout.cancel(timer);
	    	}
	    	timer = $timeout(function (){

		    	$rootScope.loading('show');

		    	loadData(function (){
			    	$rootScope.loading('hide');
		    	});
	    	}, 700);

	    }

	    /* EVENT WATCHERS */

		var watchers = {};
		watchers['search'] = $scope.$watch(function() {
			return $location.search().search;
		}, function(v, old) {

			if (v == old){
				return;
			}

			$scope.search.query = v;
			startCalling();
		});

		watchers['type'] = $scope.$watch(function() {
			return $location.search().type;
		}, function(v, old) {

			if (v == old){
				return;
			}

			$scope.search.type = v;
			startCalling();
		});

		watchers['offset'] = $scope.$watch(function() {
			return $location.search().offset;
		}, function(v, old) {

			if (v == old){
				return;
			}

			$scope.pagination.offset = v;
			startCalling();
		});

		$scope.$on('$destroy', function (){
			for(var key in watchers){
				watchers[key]();
			}
			$location.search('offset', null);
			$location.search('search', null);
		});
        
        // EDIT WITH POPUP
		$rootScope.$on('dataDirectoryItemSaved', function (){
			loadData();
		});

		// Additional dialog
		$scope.showDialog = function (type, item, ev){
			switch (type){
				case 'item':
					$mdDialog.show({
						controller: 'DashboardItemsViewDialogCtrl',
						templateUrl: '/partials/dashboard.items.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item
						}
					})
					.then(function(answer) {}, function() {});
				break;
			}
		};

		function capitalizeFirstLetter(string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		}

		$scope.removeDialog = function (type, item, ev){
			var resources = {
				'item': CoResource.resources.Item,
			};
			if (item){

				var confirm = $mdDialog.confirm()
	                .parent(angular.element(document.body))
	                .title('Remove ' + type + '?')
	                .content('Are sure to remove this ' + type + ' info? You cannot undo after you delete it')
	                .ariaLabel('Remove '+ type + '')
	                .ok('Yes')
	                .cancel('No')
	                .targetEvent(ev);
	            $mdDialog.show(confirm).then(function() {
	                $rootScope.loading('show');
					var query = {
	                	id: $scope.data.id,
	                };
					query[type + 'Id'] = item.id;
	                resources[type].delete(query, {}, function (s){
	                	$rootScope.loading('hide');
						$rootScope.$emit('dataDirectory' + capitalizeFirstLetter(type) + 'Saved');
	                }, function (e){
	                	$rootScope.loading('hide');
	                	alert('Sorry, this item cannot be set due to some reason, please contact administrator for more information');
	                });

	            }, function() {
	            });
			}
		};

		// Customized
        $scope.item_selected = [];
		$scope.removeItem = function (ev){
			var item = $scope.item_selected[0];
			$scope.removeDialog('item', item, ev);
		};
		
		$scope.editItem = function (ev){
			var item = $scope.item_selected[0];
			if (item){
				$scope.showDialog('item', item);
			}
			else{
				// There is nothing to edit!
			}
		};

		$scope.addItem = function (ev){
			$scope.showDialog('item', {
                item_type: $scope.search.type
            });
		};


    }]);
}(app));