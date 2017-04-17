(function (){
	app.controller('AssignDriverDialogCtrl', ['$scope', '$timeout', '$mdSidenav',
		'$mdUtil', '$log', '$location', '$mdDialog', '$rootScope', '$current',
		'$mdToast', 'CoResource', 'Upload', '$timeout', '$routeParams', function($scope, $timeout, $mdSidenav,
		$mdUtil, $log, $location, $mdDialog, $rootScope, $current,
		$mdToast, CoResource, Upload, $timeout, $routeParams ){
		$scope.data = $current ? angular.copy($current) : null;
		$scope.data.driver_id = $scope.data.driver ? $scope.data.driver._id : null;
		$scope.type_name = 'District';

		$scope.toastPosition = {
	    	bottom: false,
	    	top: true,
	    	left: false,
	    	right: true
	  	};

		if (!$scope.data.locale){
			$scope.data.locale =  {
				kh: {}
			};
		}

		if (!$scope.data.locale.kh){
			$scope.data.locale.kh = $scope.data.locale.kh || {};
		}

		$scope.mode = !!$scope.data._id ? 'edit' : 'create';


		// Load driver
		CoResource.resources.TourBooking.getDrivers({
			'latitude': $scope.data.pickup_lat,
			'longitude': $scope.data.pickup_lng,
	    	'radius': 20000,
	    }, function(s) {
	    	$scope.drivers = s.result;
	    });


	  	$scope.getToastPosition = function() {
	    	return Object.keys($scope.toastPosition)
	      		.filter(function(pos) { return $scope.toastPosition[pos]; })
	      		.join(' ');
	  	};

	 	$scope.close = function (){
	 		$mdDialog.hide();
	 	};

	 	$scope.save = function ($event){
	 		// console.log($scope.data);
	 		// return;
	 		if (!$scope.data || !$scope.data.driver_id){
	 			return;
	 		}

	 		var success = function (){
		 		$current = $scope.data;
		 		$rootScope.$emit('dataDriverAssigned', {
		 			mode: 'edit',
		 			$current: $current
		 		});
		 		return $mdDialog.show(
			      	$mdDialog.alert({
	                    preserveScope: true,
	                    autoWrap: true,
	                    skipHide: true,
	                    // parent: angular.element(document.body),
	                    title: 'Driver assigned',
	                    content: 'Driver has been assigned',
	                    ariaLabel: 'Driver assigned',
	                    ok: 'Got it!'
			      	})
			    )
	          	.finally(function() {
	            	$mdDialog.hide();
	          	});
	 		};

	 		var fail = function (f){
		 		return $mdDialog.show(
			      	$mdDialog.alert({
	                    preserveScope: true,
	                    autoWrap: true,
	                    skipHide: true,
	                    // parent: angular.element(document.body),
	                    title: 'Driver assigned',
	                    content: 'There was an error while assigning driver. ' + f,
	                    ariaLabel: 'Driver assigned',
	                    ok: 'Got it!'
			      	})
			    );
	 		};
	 		$rootScope.loading('show');
	 		// console.log($scope.data.driver_id);
	 		// return;
	 		if ($scope.data.id){
	 			CoResource.resources.TourBooking.assignDriver({
	 				orderId: $scope.data._id
	 			}, {
	 				driver: $scope.data.driver_id,
	 				remark: $scope.data.remark
	 			}, function(){

 					success();
 					$rootScope.loading('hide');
	 			}, function (e){
 					$rootScope.loading('hide');
 					fail(CoResource.textifyError(e.data));
 				});
	 		}
	 		else{
	 		}
	 	};


	}]);
}());
