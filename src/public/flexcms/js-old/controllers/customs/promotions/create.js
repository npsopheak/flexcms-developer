(function (){
	app.controller('PromotionCreateCtrl', function($scope, uiGmapGoogleMapApi,
		CoResource, $routeParams, $rootScope, $mdDialog, $mdToast, Upload, $timeout, $location){

		$scope._id = $routeParams.id;
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
		$scope.data = CoResource.resources.PromotionNotification
			.get({ promotionId: $scope._id || 'NO_DATA' }, function (s){
				$scope.loading = false;

				$rootScope.loading('hide');
				if (!s.result){
					$scope.mode = 'create';
					$scope.data = {};
				}
				else{
					$scope.data = $scope.data.result;
					$scope.mode = 'edit';
					$scope.data.is_active = $scope.data.is_active ? true : false;
				}
			}, function (f){
				$scope.loading = false;
				$rootScope.loading('hide');
			});


    	$scope.uploadingFile = {
    		src: '',
    		obj: null
    	};

    	$scope.pendingUploads = [];
    	$scope.savePendingUploads = function ()
    	{

    		_.each($scope.pendingUploads, function (v, k){
    			v.loading = true;
    			if (v.type == 'logo'){
		    		$scope.chooseFile(v, function (data){
		            	$scope.uploadingFile.loading = false;
		            	var result = data.result;
		            	$scope.data.image = result.id;
		            	$scope.submit(true);
		            	$rootScope.loading('hide');
		            	$mdDialog.hide();
		            	$scope.data.image = result;
		    		});
    			}
    			else{
	    			// $scope.chooseFile($scope.pendingUploads[k], function (data, file){
	    			// 	$scope.data.photos = $scope.data.photos || [];
	    			// 	$scope.data.photos.push(data.result);
	    			// 	for(var i = $scope.pendingFiles.length - 1; i >= 0; i--){
	    			// 		if (file.id === $scope.pendingFiles[i].id){
	    			// 			$scope.pendingFiles.splice(i, 1);
	    			// 		}
	    			// 	}
	    			// 	setTimeout(function (){
			     //    		renderMagnific();
			     //    	}, 200);
	    			// });
    			}
    		});
    		$scope.pendingUploads = [];
    	};

    	$scope.uploadLogo = function (files){
    		if (!files.length){
    			return;
    		}
    		$scope.uploadingFile = {
    			file: files[0],
    			type: 'logo',
    			src: window.URL.createObjectURL(files[0])
    		};
    		if ($scope.mode === 'create'){
    			$scope.pendingUploads = _.filter($scope.pendingUploads, function (v){
    				return v.type != 'logo';
    			});
	    		$scope.pendingUploads.push($scope.uploadingFile);
    		}
    		else{
    			$scope.uploadingFile.loading = true;
	    		$scope.chooseFile($scope.uploadingFile, function (data){
	            	$scope.uploadingFile.loading = false;
	            	$scope.uploadingFile.src = false;
	            	var result = data.result;
	            	$scope.data.logo_id = result.id;
	            	$scope.submit(true);
	            	$rootScope.loading('hide');
	            	$mdDialog.hide();
	            	$timeout(function() {
	            		$scope.data.logo = result;
	            	}, 6000);

	    		});
    		}
    	};

    	$scope.pendingFiles = [];
    	$scope.uploadMedia = function (files){
    		_.each(files, function (v, k){
    			var file = {
    				file: files[k],
    				id: namespace.guid(),
    				type: 'gallery',
    				src: window.URL.createObjectURL(v)
    			};
    			$scope.pendingFiles.push(file);
    			if ($scope.mode === 'create'){
    				$scope.pendingUploads.push(file);
    			}
    			else{
    				file.loading = true;
	    			$scope.chooseFile(file, function (data, file){
	    				$scope.data.photos = $scope.data.photos || [];
	    				$scope.data.photos.push(data.result);
	    				for(var i = $scope.pendingFiles.length - 1; i >= 0; i--){
	    					if (file.id === $scope.pendingFiles[i].id){
	    						$scope.pendingFiles.splice(i, 1);
	    					}
	    				}
	    				setTimeout(function (){
			        		renderMagnific();
			        	}, 200);
	    			});
    			}
    		});
    	};

    	$scope.chooseFile = function (filetmp, callback){

			filetmp.loading = true;
			$rootScope.loading('show');

			var url = $rootScope.remoteUrl + '/admin/promotions/notifications/' + $scope.data._id + '/' + (filetmp.type == 'logo' ? 'cover' : 'galleries');

			// console.log(url);
			// return;

            $scope.upload = Upload.upload({
                url: url,
                method: 'POST',
                //headers: {'Authorization': 'xxx'}, // only for html5
                //withCredentials: true,
                method: 'POST',
                headers: {
                }, // only for html5
                data: {
                	// upload_session_key: namespace.guid()
                },
                file: filetmp.file,
            }).progress(function(evt) {
                // evt.config.file.progress = parseInt(100.0 * evt.loaded / evt.total);
                filetmp.progress = parseInt(100.0 * evt.loaded / evt.total);
            }).success(function(data, status, headers, config) {
            	if (callback){
            		callback(data, filetmp);
            	}

				$rootScope.loading('hide');
				$mdToast.show(
			      	$mdToast.simple()
			        	.content('File uploaded')
			        	.position($scope.getToastPosition())
			        	.hideDelay(3000)
			    );

			    if (filetmp.type == 'gallery'){
			    	$scope.data.gallery = $scope.data.gallery || [];
			    	data.result.thumbnail_url_link = filetmp.src;
			    	$scope.data.gallery.unshift(data.result);
			    }
			    else if (filetmp.type == 'logo'){
			    	// data.result.thumbnail_url_link = filetmp.src;
			    	// $(function() {
			    	// 	$scope.data.logo = data.result;
			    	// }, 3000);

			    }

            }).error(function(data, status, headers, config) {
            	alert('There was an error while trying to upload file.');
            	console.log(data, status);
            	$scope.uploadingFile.loading = false;
            	$rootScope.loading('hide');
            });
    	};

    	/* START: HANDLE CATEGORY */

		
	    $scope.submit = function (hideDialog){
	    	

	    	$rootScope.loading('show');

	    	if ($scope.mode === 'create'){
	    		// $scope.data.hash = $scope.hash;

	 			var item = new CoResource.resources.PromotionNotification($scope.data);
	 			item.$save(function (s, h){
	 				$scope.data = s.result;
	 				$scope.mode = 'edit';
	 				$rootScope.loading('hide');
	 				$scope.savePendingUploads();
	 				if (!hideDialog){
	 					return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Create Promotion Listing')
						        .content('Promotion listing is successfully created')
						        .ariaLabel('Create Promotion Listing')
						        .ok('Got it!')
						)
		                .then(function(answer) {
		                    $location.path('promotions/' + $scope.data._id);
		                }, function() {
		                    $location.path('promotions/' + $scope.data._id);
		                });
	 				}
	 			}, function (f){
 					$rootScope.loading('hide');
 					$scope.savePendingUploads();
 					if (!hideDialog){
	 					return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Create Promotion Listing')
						        .content('There was an error while creating Promotion listing. ' + CoResource.textifyError(f.data))
						        .ariaLabel('Create Promotion Listing')
						        .ok('Got it!')
					    );
	 				}
 				});

	    	}
	    	else{

	    // 		var item = new CoResource.resources.PromotionNotification.get({
	 			// 	promotionId: $scope.data._id
	 			// }, function(){
	 			// 	item = _.extend(item, $scope.data);
	 			// 	item.$update({promotionId: $scope.data._id}, function (s, h){

		 		// 		$rootScope.loading('hide');
		 		// 		if (hideDialog){
					// 		return $mdToast.show(
					// 	      	$mdToast.simple()
					// 	        	.content('Map updated')
					// 	        	.position($scope.getToastPosition())
					// 	        	.hideDelay(3000)
					// 	    );
		 		// 		}
	 			// 		return $mdDialog.show(
			  //     			$mdDialog.alert()
					// 	        .parent(angular.element(document.body))
					// 	        .title('Update Promotion Listing')
					// 	        .content('Promotion listing is successfully updated')
					// 	        .ariaLabel('Update Promotion Listing')
					// 	        .ok('Got it!')
					// 	    );
	 			// 	}, function (e){
	 			// 		$rootScope.loading('hide');
	 			// 		// fail(CoResource.textifyError(e.data));

		   //    			return $mdDialog.show(
			  //     			$mdDialog.alert()
					// 	        .parent(angular.element(document.body))
					// 	        .title('Error Update Promotion Listing')
					// 	        .content(CoResource.textifyError(e.data))
					// 	        .ariaLabel('Update Promotion Listing')
					// 	        .ok('Got it!')
					// 	    );
	 			// 	});
	 			// }, function (e){
 				// 	$rootScope.loading('hide');
 				// 	return $mdDialog.show(
		   //    			$mdDialog.alert()
					//         .parent(angular.element(document.body))
					//         .title('Update Promotion Listing')
					//         .content('There was an error while updating Promotion listing. ' + CoResource.textifyError(e.data))
					//         .ariaLabel('Update Promotion Listing')
					//         .ok('Got it!')
					//     );
 				// });
	    	}
	    };

	

	  //   $scope.deletePendingPhoto = function (item){
	  //   	for(var i = $scope.pendingFiles.length - 1; i >= 0; i--){
			// 	if (item.id === $scope.pendingFiles.id){
			// 		$scope.pendingFiles.splice(i, 1);
			// 	}
			// }
	  //   };

   //      $scope.deletePhoto = function (item, ev){
   //          // Appending dialog to document.body to cover sidenav in docs app
   //          if (!item){
   //              return;
   //          }
   //          var confirm = $mdDialog.confirm()
   //              .parent(angular.element(document.body))
   //              .title('Delete this gallery?')
   //              .content('Are sure to do so? Once you deleted, you won\'t be able to retrieve it back!')
   //              .ariaLabel('Delete Media')
   //              .ok('Yes')
   //              .cancel('No')
   //              .targetEvent(ev);
   //          $mdDialog.show(confirm).then(function() {
   //              $rootScope.loading('show');
   //              CoResource.resources.Media.delete({
   //              	mediaId: item._id
   //              }, function (s){
   //              	$rootScope.loading('hide');
   //              	for(var i = $scope.data.gallery.length - 1; i >= 0; i--){
   //  					if (item._id === $scope.data.gallery[i]._id){
   //  						$scope.data.gallery.splice(i, 1);
   //  					}
   //  				}
   //              	$mdToast.show(
   //                      $mdToast.simple()
   //                          .content('Gallery removed')
   //                          .position($scope.getToastPosition())
   //                          .hideDelay(3000)
   //                  );
   //              }, function (e){
   //              	$rootScope.loading('hide');
   //              	alert('Sorry, this media cannot be deleted due to some reason, please contact administrator for more information');
   //              });

   //          }, function() {
   //          });
   //      };

   //      $scope.updateCover = function (item, ev){
   //          // Appending dialog to document.body to cover sidenav in docs app
   //          if (!item || item._id == $scope.data.cover_media){
   //              return;
   //          }
   //          var confirm = $mdDialog.confirm()
   //              .parent(angular.element(document.body))
   //              .title('Set this gallery as cover?')
   //              .content('Are sure to do set this image as Promotion cover?')
   //              .ariaLabel('Set Cover')
   //              .ok('Yes')
   //              .cancel('No')
   //              .targetEvent(ev);
   //          $mdDialog.show(confirm).then(function() {
   //              $rootScope.loading('show');
   //              CoResource.resources.Promotion.setCover({
   //              	PromotionId: $scope.data._id
   //              }, {
			// 		cover_media: item._id
			// 	}, function (s){
   //              	$rootScope.loading('hide');
			// 		$scope.data.cover_media = item._id;

   //              	$mdToast.show(
   //                      $mdToast.simple()
   //                          .content('Cover set')
   //                          .position($scope.getToastPosition())
   //                          .hideDelay(3000)
   //                  );
   //              }, function (e){
   //              	$rootScope.loading('hide');
   //              	alert('Sorry, this media cannot be set due to some reason, please contact administrator for more information');
   //              });

   //          }, function() {
   //          });
   //      };


		// $scope.delete = function ($event){
		// 	if ($scope.data._id){

		// 		var confirm = $mdDialog.confirm()
	 //                .parent(angular.element(document.body))
	 //                .title('Remove Promotion?')
	 //                .content('Are sure to remove this Promotion? You cannot undo after you delete it')
	 //                .ariaLabel('Remove Promotion')
	 //                .ok('Yes')
	 //                .cancel('No')
	 //                .targetEvent($event);
	 //            $mdDialog.show(confirm).then(function() {
	 //                $rootScope.loading('hide');
	 //                CoResource.resources.Promotion.delete({
	 //                	PromotionId: $scope.data._id
	 //                }, {}, function (s){
	 //                	$rootScope.loading('hide');
		// 				$location.path('/');
	 //                }, function (e){
	 //                	$rootScope.loading('hide');
	 //                	alert('Sorry, this Promotion cannot be set due to some reason, please contact administrator for more information');
	 //                });

	 //            }, function() {
	 //            });
		// 	}
		// };


		$scope.deletePhotoLogo = function ($event){
			if ($scope.data._id){

				var confirm = $mdDialog.confirm()
	                .parent(angular.element(document.body))
	                .title('Remove Promotion image?')
	                .content('Are sure to remove this Promotion image? You cannot undo after you delete it')
	                .ariaLabel('Remove Promotion')
	                .ok('Yes')
	                .cancel('No')
	                .targetEvent($event);
	            $mdDialog.show(confirm).then(function() {
	                $rootScope.loading('show');
	                CoResource.resources.PromotionNotification.deleteLogo({
	                	promotionId: $scope.data._id
	                }, {}, function (s){
	                	$rootScope.loading('hide');
						$scope.data.image = null;
	                }, function (e){
	                	$rootScope.loading('hide');
	                	alert('Sorry, this Promotion image cannot be set due to some reason, please contact administrator for more information');
	                });

	            }, function() {
	            });
			}
		};

        $(function() {

            // uiGmapGoogleMapApi is a promise.
            // The "then" callback function provides the google.maps object.
            // uiGmapGoogleMapApi.then(function(maps) {
            //     console.log(maps.Map.controls);
            // });

            $('#pac-input').keydown(function(e) {
                e.stopPropagation();
            });
        });

        // $scope.showMapSearchBox = false;

        $timeout(function() {
            var input = document.getElementById('pac-input');
            if (!input){
            	return;
            }
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());

            });
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
               	$scope.map.center.latitude = places[0].geometry.location.lat();
               	$scope.map.center.longitude = places[0].geometry.location.lng();
               	$scope.marker.coords.latitude = places[0].geometry.location.lat();
               	$scope.marker.coords.longitude = places[0].geometry.location.lng();
               	$scope.$apply();
            });

            $scope.showMapSearchBox = true;

        }, 2000);

	});
}());
