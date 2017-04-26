(function(app) {
    app.controller('DashboardArticlesCreateCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {

	    
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

		$scope.data = CoResource.resources.Location
			.get({ locationId: $scope._id || 'NO_DATA' }, function (s){
				$scope.loading = false;


				$rootScope.loading('hide');
				if (!s.result){
					$scope.mode = 'create';
					$scope.data = {};

				    if (navigator.geolocation) {
				        navigator.geolocation.getCurrentPosition(function (position){
				        	$scope.map.center.latitude = position.coords.latitude; // || 11.5449;
				        	$scope.map.center.longitude = position.coords.longitude; // || 104.8922;
				        	$scope.marker.coords.latitude = position.coords.latitude; // || 11.5449;
				        	$scope.marker.coords.longitude = position.coords.longitude; // || 104.8922;
				        	$scope.$apply();
				        });
				    }
					$scope.data.is_recommended = false;

					// if (!$scope.data.locale){
					// 	$scope.data.locale =  {
					// 		kh: {}
					// 	};
					// }

					// if (!$scope.data.locale.kh){
					// 	$scope.data.locale.kh = $scope.data.locale.kh || {};
					// }
				}
				else{
					$scope.data = $scope.data.result;
					$scope.mode = 'edit';
					$scope.data.is_active = $scope.data.is_active ? true : false;

		        	$scope.map.center.latitude = $scope.data.latitude; // || 11.5449;
		        	$scope.map.center.longitude = $scope.data.longitude; // || 104.8922;
		        	$scope.marker.coords.latitude = $scope.data.latitude; // || 11.5449;
		        	$scope.marker.coords.longitude = $scope.data.longitude; // || 104.8922;

			    	$scope.selectedCategories = _.map($scope.data.category, function (v){
			    		return v;
			    	});

		        	setTimeout(function (){
		        		renderMagnific();
		        	}, 200);
				}
			}, function (f){
				$scope.loading = false;
				$rootScope.loading('hide');
			});

		$scope.categories = [];
		$scope.map = { center: { latitude: 45, longitude: -73 }, zoom: 13 ,
			control: {

			},
			events: {
				click: function (e, v, args){
					$scope.marker.coords.latitude = args[0].latLng.lat();
					$scope.marker.coords.longitude = args[0].latLng.lng();
					$scope.data.latitude = args[0].latLng.lat();
					$scope.data.longitude = args[0].latLng.lng();
					$scope.$apply();
				}
			}
		};

		$scope.onLatLngChanged = function (){
			if ($scope.data.latitude * 1.0 &&  $scope.data.longitude * 1.0){
				$scope.marker.coords.latitude = $scope.data.latitude;
				$scope.marker.coords.longitude = $scope.data.longitude;
				$scope.map.center.latitude = $scope.data.latitude;
				$scope.map.center.longitude = $scope.data.longitude;
			}
		};

		$scope.marker = {
	      	id: 0,
	      	coords: {
	        	latitude: 40.1451,
	        	longitude: -99.6680
	      	},
	      	options: {
	      		draggable: true ,
	      		title: 'Your selected position is here'
	      	},
	      	events: {
	        	dragend: function (marker, eventName, args) {
					var lat = marker.getPosition().lat();
					var lon = marker.getPosition().lng();
					$scope.data.latitude = lat;
					$scope.data.longitude = lon;
					// if ($scope.mode == 'edit'){
					// 	$scope.submit(true);
					// }
	        	}
	      	}
	    };


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
		            	$scope.data.logo_id = result.id;
		            	$scope.submit(true);
		            	$rootScope.loading('hide');
		            	$mdDialog.hide();
		            	$scope.data.logo = result;
		    		});
    			}
    			else{
	    			$scope.chooseFile($scope.pendingUploads[k], function (data, file){
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

			var url = $rootScope.remoteUrl + '/admin/locations/' + $scope.data._id + '/' + (filetmp.type == 'logo' ? 'logo' : 'galleries');

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

		$scope.categories = CoResource.resources.Item.list({
	    	'type': 'category',
	    	'ignore-offset': 1,
	    }, function(s) {
	    	$scope.categories = s.result;
	    });
		$scope.select_categories = [];
		$scope.itemChange = function (v){
			$scope.select_categories = _.filter($scope.select_categories, function(v){
				return _.isObject(v) ? v : {
                    display_name: v,
                    name: namespace.urlify(v)
                };
			});
		};

		$scope.$watch('select_categories', function (v){

		});

		$scope.querySearch = function (query) {
			var results = query && _.isArray($scope.categories) ? _.filter($scope.categories, function (v){
				return v.display_name.toLowerCase().indexOf(query.toLowerCase()) > -1
			}) : [];
			return results;
		}

		/* START: HANDLE FEATURES */

		$scope.features = CoResource.resources.Item.list({
	    	'type': 'feature',
	    	'ignore-offset': 1,
	    }, function(s) {
	    	$scope.features = s.result;
	    });
		$scope.select_features = [];
		$scope.itemChangeGeneric = function (listName){
			$scope[listName] = _.filter($scope[listName], function(v){
				return _.isObject(v) ? v : {
                    display_name: v,
                    name: namespace.urlify(v)
                };
			});
		};

		$scope.newItems = function (chip){
			return _.isObject(chip) ? chip : {
                display_name: chip,
                name: namespace.urlify(chip)
            };
		};

		/* START: HANDLE ORIGINS */

		/* HANDLE GENERIC*/

		$scope.querySearchGeneric = function (query, listName) {
			var results = query && _.isArray($scope[listName]) ? _.filter($scope[listName], function (v){
				return v.display_name.toLowerCase().indexOf(query.toLowerCase()) > -1
			}) : [];
			return results;
		}

	    $scope.submit = function (hideDialog){
	    	if (!$scope.data.latitude){
	    		$scope.data.latitude = $scope.map.center.latitude;
	    	}
	    	if (!$scope.data.longitude){
	    		$scope.data.longitude = $scope.map.center.longitude;
	    	}
	    	$scope.data.category = $scope.selectedCategories;

	    	$rootScope.loading('show');

	    	if ($scope.mode === 'create'){
	    		// $scope.data.hash = $scope.hash;

	 			var item = new CoResource.resources.Location($scope.data);
	 			item.$save(function (s, h){
	 				$scope.data = s.result;
	 				$scope.mode = 'edit';
	 				$rootScope.loading('hide');
	 				$scope.savePendingUploads();
	 				if (!hideDialog){
	 					return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Create Location Listing')
						        .content('Location listing is successfully created')
						        .ariaLabel('Create Location Listing')
						        .ok('Got it!')
						)
		                .then(function(answer) {
		                    $location.path('locations/' + $scope.data._id);
		                }, function() {
		                    $location.path('locations/' + $scope.data._id);
		                });
	 				}
	 			}, function (f){
 					$rootScope.loading('hide');
 					$scope.savePendingUploads();
 					if (!hideDialog){
	 					return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Create Location Listing')
						        .content('There was an error while creating Location listing. ' + CoResource.textifyError(f.data))
						        .ariaLabel('Create Location Listing')
						        .ok('Got it!')
					    );
	 				}
 				});

	    	}
	    	else{

	    		var location = new CoResource.resources.Location.get({
	 				locationId: $scope.data._id
	 			}, function(){
	 				location = _.extend(location, $scope.data);
	 				location.$update({locationId: $scope.data._id}, function (s, h){

		 				$rootScope.loading('hide');
		 				if (hideDialog){
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
						        .title('Update Location Listing')
						        .content('Location listing is successfully updated')
						        .ariaLabel('Update Location Listing')
						        .ok('Got it!')
						    );
	 				}, function (e){
	 					$rootScope.loading('hide');
	 					// fail(CoResource.textifyError(e.data));

		      			return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Error Update Location Listing')
						        .content(CoResource.textifyError(e.data))
						        .ariaLabel('Update Location Listing')
						        .ok('Got it!')
						    );
	 				});
	 			}, function (e){
 					$rootScope.loading('hide');
 					return $mdDialog.show(
		      			$mdDialog.alert()
					        .parent(angular.element(document.body))
					        .title('Update Location Listing')
					        .content('There was an error while updating Location listing. ' + CoResource.textifyError(e.data))
					        .ariaLabel('Update Location Listing')
					        .ok('Got it!')
					    );
 				});
	    	}
	    };

	    // Manific
	    function renderMagnific(){
	        $('.media-gallery .media.uploaded').magnificPopup({
	            type: 'image',
	            removalDelay: 300,
	            mainClass: 'mfp-with-zoom',
	            delegate: 'span.icon-search', // the selector for gallery item,
	            titleSrc: 'title',
	            tLoading: '',
	            gallery: {
	                enabled: true
	            },
	            callbacks: {
	                imageLoadComplete: function() {
	                    var self = this;
	                    setTimeout(function() {
	                        self.wrap.addClass('mfp-image-loaded');
	                    }, 16);
	                },
	                open: function() {
	                    // $('#header > nav').css('padding-right', getScrollBarWidth() + "px");
	                },
	                close: function() {
	                    this.wrap.removeClass('mfp-image-loaded');
	                    // $('#header > nav').css('padding-right', "0px");
	                },
	            }
	        });
	    }

	    $scope.deletePendingPhoto = function (item){
	    	for(var i = $scope.pendingFiles.length - 1; i >= 0; i--){
				if (item.id === $scope.pendingFiles.id){
					$scope.pendingFiles.splice(i, 1);
				}
			}
	    };

        $scope.deletePhoto = function (item, ev){
            // Appending dialog to document.body to cover sidenav in docs app
            if (!item){
                return;
            }
            var confirm = $mdDialog.confirm()
                .parent(angular.element(document.body))
                .title('Delete this gallery?')
                .content('Are sure to do so? Once you deleted, you won\'t be able to retrieve it back!')
                .ariaLabel('Delete Media')
                .ok('Yes')
                .cancel('No')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                $rootScope.loading('show');
                CoResource.resources.Media.delete({
                	mediaId: item._id
                }, function (s){
                	$rootScope.loading('hide');
                	for(var i = $scope.data.gallery.length - 1; i >= 0; i--){
    					if (item._id === $scope.data.gallery[i]._id){
    						$scope.data.gallery.splice(i, 1);
    					}
    				}
                	$mdToast.show(
                        $mdToast.simple()
                            .content('Gallery removed')
                            .position($scope.getToastPosition())
                            .hideDelay(3000)
                    );
                }, function (e){
                	$rootScope.loading('hide');
                	alert('Sorry, this media cannot be deleted due to some reason, please contact administrator for more information');
                });

            }, function() {
            });
        };

        $scope.updateCover = function (item, ev){
            // Appending dialog to document.body to cover sidenav in docs app
            if (!item || item._id == $scope.data.cover_media){
                return;
            }
            var confirm = $mdDialog.confirm()
                .parent(angular.element(document.body))
                .title('Set this gallery as cover?')
                .content('Are sure to do set this image as Location cover?')
                .ariaLabel('Set Cover')
                .ok('Yes')
                .cancel('No')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                $rootScope.loading('show');
                CoResource.resources.Location.setCover({
                	locationId: $scope.data._id
                }, {
					cover_media: item._id
				}, function (s){
                	$rootScope.loading('hide');
					$scope.data.cover_media = item._id;

                	$mdToast.show(
                        $mdToast.simple()
                            .content('Cover set')
                            .position($scope.getToastPosition())
                            .hideDelay(3000)
                    );
                }, function (e){
                	$rootScope.loading('hide');
                	alert('Sorry, this media cannot be set due to some reason, please contact administrator for more information');
                });

            }, function() {
            });
        };


		/* START: Update Location listing  */

  		$scope.edit = function($event){
  			if ($scope.selected.length == 1){
				$scope.editDimension($scope.selected[0], $event);
  			}
  		};

		$scope.delete = function ($event){
			if ($scope.data._id){

				var confirm = $mdDialog.confirm()
	                .parent(angular.element(document.body))
	                .title('Remove location?')
	                .content('Are sure to remove this location? You cannot undo after you delete it')
	                .ariaLabel('Remove location')
	                .ok('Yes')
	                .cancel('No')
	                .targetEvent($event);
	            $mdDialog.show(confirm).then(function() {
	                $rootScope.loading('Location');
	                CoResource.resources.Location.delete({
	                	locationId: $scope.data._id
	                }, {}, function (s){
	                	$rootScope.loading('hide');
						$location.path('/');
	                }, function (e){
	                	$rootScope.loading('hide');
	                	alert('Sorry, this Location cannot be set due to some reason, please contact administrator for more information');
	                });

	            }, function() {
	            });
			}
		};


		$scope.deletePhotoLogo = function ($event){
			if ($scope.data._id){

				var confirm = $mdDialog.confirm()
	                .parent(angular.element(document.body))
	                .title('Remove location logo?')
	                .content('Are sure to remove this location logo? You cannot undo after you delete it')
	                .ariaLabel('Remove location')
	                .ok('Yes')
	                .cancel('No')
	                .targetEvent($event);
	            $mdDialog.show(confirm).then(function() {
	                $rootScope.loading('show');
	                CoResource.resources.Location.deleteLogo({
	                	locationId: $scope.data._id
	                }, {}, function (s){
	                	$rootScope.loading('hide');
						$scope.data.logo = null;
	                }, function (e){
	                	$rootScope.loading('hide');
	                	alert('Sorry, this location logo cannot be set due to some reason, please contact administrator for more information');
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

        /* New chip */
        $scope.selectedCategories = [];
        $scope.category = ['hotel', 'spa', 'restuarant', 'cafe'];

        $scope.selectedItem = null;
        $scope.searchText = null;

        $scope.querySearchCategory = function (query){
        	return _.map(_.filter($scope.category, function (v){
        		return v.indexOf((query || '').toLowerCase()) != -1;
        	}), function (v){
        		return v;
        	});
        };

        $timeout(function() {
            console.log($scope.map);
            var map = $scope.map.control.getGMap();
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

    }]);
}(app));