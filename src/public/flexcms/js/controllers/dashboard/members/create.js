(function(app) {
    app.controller('DashboardMembersCreateCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', 'Upload', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter, Upload) {

	    
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
        $scope.staff_selected = [];
        $scope.donor_selected = [];
        $scope.budget_selected = [];
        $scope.activity_selected = [];
        $scope.contact_selected = [];
		$scope.library_selected = [];
		$scope.user_selected = [];
		$scope.data = {};
		$scope.mode = 'create';

		function resetRelated(){
			$scope.staffs = [];
			$scope.donors = [];
			$scope.budgets = [];
			$scope.activities = [];
			$scope.contact_selected = [];
		}

        function loadRelated(memberId){
            CoResource.resources.MemberStaff
			    .get({ id: memberId }, function (s){
                    $scope.staffs = s.result;
                });
            // CoResource.resources.MemberStaff
			//     .get({ id: memberId, staffId: 2 }, function (s){
            //         $scope.staffs = s.result;
            //     });
            
            CoResource.resources.MemberDonor
			    .get({ id: memberId }, function (s){
                    $scope.donors = s.result;
                });
            CoResource.resources.MemberBudget
			    .get({ id: memberId }, function (s){
                    $scope.budgets = s.result;
                });
            CoResource.resources.MemberActivity
			    .get({ id: memberId }, function (s){
                    $scope.activities = s.result;
                });
            CoResource.resources.MemberContact
			    .get({ id: memberId }, function (s){
                    $scope.contacts = s.result;
                });
            CoResource.resources.MemberLibrary
			    .get({ id: memberId }, function (s){
                    $scope.libraries = s.result;
                });
			CoResource.resources.MemberUser
			    .get({ id: $scope.data.id }, function (s){
                    $scope.users = s.result;
                });
        }


		$rootScope.$on('dataDirectoryStaffSaved', function (){
			CoResource.resources.MemberStaff
			    .get({ id: $scope.data.id }, function (s){
                    $scope.staffs = s.result;
                });
		});


		$rootScope.$on('dataDirectoryBudgetSaved', function (){
			CoResource.resources.MemberBudget
			    .get({ id: $scope.data.id }, function (s){
                    $scope.budgets = s.result;
                });
		});

		$rootScope.$on('dataDirectoryActivitySaved', function (){
			CoResource.resources.MemberActivity
			    .get({ id: $scope.data.id }, function (s){
                    $scope.activities = s.result;
                });
		});

		$rootScope.$on('dataDirectoryContactSaved', function (){
			CoResource.resources.MemberContact
			    .get({ id: $scope.data.id }, function (s){
                    $scope.contacts = s.result;
                });
		});

		$rootScope.$on('dataDirectoryDonorSaved', function (){
			CoResource.resources.MemberDonor
			    .get({ id: $scope.data.id }, function (s){
                    $scope.donors = s.result;
                });
		});

		$rootScope.$on('dataDirectoryLibrarySaved', function (){
			CoResource.resources.MemberLibrary
			    .get({ id: $scope.data.id }, function (s){
                    $scope.libraries = s.result;
                });
		});

		$rootScope.$on('dataDirectoryUserSaved', function (){
			CoResource.resources.MemberUser
			    .get({ id: $scope.data.id }, function (s){
                    $scope.users = s.result;
                });
		});
        

		$scope.data = CoResource.resources.Member
			.get({ id: $scope.id || 'NO_DATA' }, function (s){
				$scope.loading = false;


				$rootScope.loading('hide');
				if (!s.result){
					$scope.mode = 'create';
					$scope.data = {};
					resetRelated();
					$scope.data.is_recommended = false;

                    $timeout(function() {
                        $('#post-editor').val('');
                        $rootScope.loading('hide');
                    }, 500);
				}
				else{
					
					$scope.data = $scope.data.result;
					$scope.mode = 'edit';
					$scope.data.is_active = $scope.data.is_active ? true : false;

			    	$scope.selectedCategories = _.map($scope.data.category, function (v){
			    		return v;
			    	});

					loadRelated($scope.data.id);

                    $timeout(function() {
                        $('#post-editor').val($scope.data.description);
                        $rootScope.loading('hide');
                    }, 500);

		        	setTimeout(function (){
		        		renderMagnific();
		        	}, 200);
				}
			}, function (f){
				$scope.loading = false;
				$rootScope.loading('hide');
			});

		$scope.categories = [];
		

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

			var url = namespace.domain + 'media'; // + $scope.data.id + '/' + (filetmp.type == 'logo' ? 'logo' : 'galleries');
			
			console.log(url, Upload);
			// return;

            $scope.upload = Upload.upload({
                url: url,
                method: 'POST',
                //headers: {'Authorization': 'xxx'}, // only for html5
                //withCredentials: true,
                // method: 'POST',
                headers: {
                }, // only for html5
                data: {
					imagable_type: 'Directory',
					imagable_id: $scope.data.id,
					caption: $scope.data.title,
					description: $scope.data.title,
					type: 'gallery'
                	// upload_session_key: namespace.guid()
                },
                file: filetmp.file,
            }).progress(function(evt) {
				console.log('progressing');
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
			    	// $scope.data.photos = $scope.data.photos || [];
			    	data.result.thumbnail_url_link = filetmp.src;
			    	// $scope.data.photos.unshift(data.result);
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
	    	// 'type': 'category',
	    	'ignore-offset': 1,
	    }, function(s) {
	    	$scope.categories = s.result;
            // Find the post category 
            var filteredItem = _.filter(s.result, function (v){
                return v.name == 'post';
            });
			console.log(filteredItem);
            if (filteredItem && filteredItem[0]){
                $scope.data.type_id = filteredItem[0].id;
            }
            // Find the post category 
            filteredItem = _.filter(s.result, function (v){
                return v.name == 'general-news';
            });
            if (filteredItem && filteredItem[0]){
                $scope.data.category_id = filteredItem[0].id;
            }
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

		// $scope.features = CoResource.resources.Item.list({
	    // 	'type': 'feature',
	    // 	'ignore-offset': 1,
	    // }, function(s) {
	    // 	$scope.features = s.result;
	    // });
		// $scope.select_features = [];

        // Handle CHIP 
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
	    	// if (!$scope.data.latitude){
	    	// 	$scope.data.latitude = $scope.map.center.latitude;
	    	// }
	    	// if (!$scope.data.longitude){
	    	// 	$scope.data.longitude = $scope.map.center.longitude;
	    	// }
			console.log($scope.data);
	    	$scope.data.category = $scope.selectedCategories;

	    	$rootScope.loading('show');

	    	if ($scope.mode === 'create'){
	    		// $scope.data.hash = $scope.hash;

	 			var item = new CoResource.resources.Member($scope.data);
	 			item.$save(function (s, h){
	 				$scope.data = s.result;
	 				$scope.mode = 'edit';
	 				$rootScope.loading('hide');
	 				$scope.savePendingUploads();
	 				if (!hideDialog){
	 					return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Create Article Listing')
						        .content('Article listing is successfully created')
						        .ariaLabel('Create Article Listing')
						        .ok('Got it!')
						)
		                .then(function(answer) {
		                    $location.path('articles/' + $scope.data.id);
		                }, function() {
		                    $location.path('articles/' + $scope.data.id);
		                });
	 				}
	 			}, function (f){
 					$rootScope.loading('hide');
 					$scope.savePendingUploads();
 					if (!hideDialog){
	 					return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Create Article Listing')
						        .content('There was an error while creating Article listing. ' + CoResource.textifyError(f.data))
						        .ariaLabel('Create Article Listing')
						        .ok('Got it!')
					    );
	 				}
 				});

	    	}
	    	else{

	    		var item = new CoResource.resources.Member.get({
	 				id: $scope.data.id
	 			}, function(){
	 				item = _.extend(item, $scope.data);
	 				item.$update({id: $scope.data.id}, function (s, h){

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
						        .title('Update Article Listing')
						        .content('Article listing is successfully updated')
						        .ariaLabel('Update Article Listing')
						        .ok('Got it!')
						    );
	 				}, function (e){
	 					$rootScope.loading('hide');
	 					// fail(CoResource.textifyError(e.data));

		      			return $mdDialog.show(
			      			$mdDialog.alert()
						        .parent(angular.element(document.body))
						        .title('Error Update Article Listing')
						        .content(CoResource.textifyError(e.data))
						        .ariaLabel('Update Article Listing')
						        .ok('Got it!')
						    );
	 				});
	 			}, function (e){
 					$rootScope.loading('hide');
 					return $mdDialog.show(
		      			$mdDialog.alert()
					        .parent(angular.element(document.body))
					        .title('Update Article Listing')
					        .content('There was an error while updating Article listing. ' + CoResource.textifyError(e.data))
					        .ariaLabel('Update Article Listing')
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
                	mediaId: item.id
                }, function (s){
                	$rootScope.loading('hide');
                	for(var i = $scope.data.photos.length - 1; i >= 0; i--){
    					if (item.id === $scope.data.photos[i].id){
    						$scope.data.photos.splice(i, 1);
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
            if (!item || item.id == $scope.data.cover_media){
                return;
            }
            var confirm = $mdDialog.confirm()
                .parent(angular.element(document.body))
                .title('Set this gallery as cover?')
                .content('Are sure to do set this image as Article cover?')
                .ariaLabel('Set Cover')
                .ok('Yes')
                .cancel('No')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                $rootScope.loading('show');
                CoResource.resources.Member.update({
                	id: $scope.data.id
                }, {
					primary_photo_id: item.id
				}, function (s){
                	$rootScope.loading('hide');
					$scope.data.primary_photo_id = item.id;
					$scope.data.primary_media = item;

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
			if ($scope.data.id){

				var confirm = $mdDialog.confirm()
	                .parent(angular.element(document.body))
	                .title('Remove Article?')
	                .content('Are sure to remove this article? You cannot undo after you delete it')
	                .ariaLabel('Remove Article')
	                .ok('Yes')
	                .cancel('No')
	                .targetEvent($event);
	            $mdDialog.show(confirm).then(function() {
	                $rootScope.loading('show');
	                CoResource.resources.Member.delete({
	                	id: $scope.data.id
	                }, {}, function (s){
	                	$rootScope.loading('hide');
						$location.path('/');
	                }, function (e){
	                	$rootScope.loading('hide');
	                	alert('Sorry, this Article cannot be set due to some reason, please contact administrator for more information');
	                });

	            }, function() {
	            });
			}
		};


		$scope.deletePhotoLogo = function ($event){
			if ($scope.data.id){

				var confirm = $mdDialog.confirm()
	                .parent(angular.element(document.body))
	                .title('Remove Article logo?')
	                .content('Are sure to remove this article logo? You cannot undo after you delete it')
	                .ariaLabel('Remove Article')
	                .ok('Yes')
	                .cancel('No')
	                .targetEvent($event);
	            $mdDialog.show(confirm).then(function() {
	                $rootScope.loading('show');
	                CoResource.resources.Article.update({
	                	id: $scope.data.id
	                }, {
						primary_photo_id: 0
					}, function (s){
	                	$rootScope.loading('hide');
						$scope.data.primary_photo_id = null;
						$scope.data.primary_media = null;
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

		// Additional dialog
		$scope.showDialog = function (type, item, ev){
			switch (type){
				case 'staff':
					$mdDialog.show({
						controller: 'DashboardStaffsViewDialogCtrl',
						templateUrl: '/partials/dashboard.staffs.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item || {
								directory_id: $scope.data.id
							}
						}
					})
					.then(function(answer) {}, function() {});
				break;
				case 'budget':
					$mdDialog.show({
						controller: 'DashboardBudgetsViewDialogCtrl',
						templateUrl: '/partials/dashboard.budgets.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item || {
								directory_id: $scope.data.id
							}
						}
					})
					.then(function(answer) {}, function() {});
				break;
				case 'activity':
					$mdDialog.show({
						controller: 'DashboardActivitiesViewDialogCtrl',
						templateUrl: '/partials/dashboard.activities.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item || {
								directory_id: $scope.data.id
							}
						}
					})
					.then(function(answer) {}, function() {});
				break;
				case 'contact':
					$mdDialog.show({
						controller: 'DashboardContactsViewDialogCtrl',
						templateUrl: '/partials/dashboard.contacts.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item || {
								directory_id: $scope.data.id
							}
						}
					})
					.then(function(answer) {}, function() {});
				break;
				case 'donor':
					$mdDialog.show({
						controller: 'DashboardDonorsViewDialogCtrl',
						templateUrl: '/partials/dashboard.donors.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item || {
								directory_id: $scope.data.id
							}
						}
					})
					.then(function(answer) {}, function() {});
				break;
				case 'library':
					$mdDialog.show({
						controller: 'DashboardLibrariesViewDialogCtrl',
						templateUrl: '/partials/dashboard.libraries.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item || {
								directory_id: $scope.data.id
							}
						}
					})
					.then(function(answer) {}, function() {});
				break;
				case 'user':
					$mdDialog.show({
						controller: 'DashboardUsersViewDialogCtrl',
						templateUrl: '/partials/dashboard.users.viewDialog',
						parent: angular.element(document.body),
						targetEvent: ev,
						locals: {
							$current: item || {
								directory_id: $scope.data.id
							}
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
				'staff': CoResource.resources.MemberStaff,
				'activity': CoResource.resources.MemberActivity,
				'budget': CoResource.resources.MemberBudget,
				'donor': CoResource.resources.MemberDonor,
				'contact': CoResource.resources.MemberContact,
				'library': CoResource.resources.MemberLibrary,
				'user': CoResource.resources.MemberLibrary,
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

		// Staff
		$scope.removeStaff = function (ev){
			var item = $scope.staff_selected[0];
			$scope.removeDialog('staff', item, ev);
		};
		
		$scope.editStaff = function (ev){
			var item = $scope.staff_selected[0];
			if (item){
				$scope.showDialog('staff', item);
			}
			else{
				// There is nothing to edit!
			}
		};

		$scope.addStaff = function (ev){
			$scope.showDialog('staff', null);
		};

		// Budget
		$scope.removeBudget = function (ev){
			var item = $scope.budget_selected[0];
			$scope.removeDialog('budget', item, ev);
		};
		
		$scope.editBudget = function (ev){
			var item = $scope.budget_selected[0];
			if (item){
				$scope.showDialog('budget', item);
			}
			else{
				// There is nothing to edit!
			}
		};

		$scope.addBudget = function (ev){
			$scope.showDialog('budget', null);
		};

		// Contact
		$scope.removeContact = function (ev){
			var item = $scope.contact_selected[0];
			$scope.removeDialog('contact', item, ev);
		};
		
		$scope.editContact = function (ev){
			var item = $scope.contact_selected[0];
			if (item){
				$scope.showDialog('contact', item);
			}
			else{
				// There is nothing to edit!
			}
		};

		$scope.addContact = function (ev){
			$scope.showDialog('contact', null);
		};

		// Activity
		$scope.removeActivity = function (ev){
			var item = $scope.activity_selected[0];
			$scope.removeDialog('activity', item, ev);
		};
		
		$scope.editActivity = function (ev){
			var item = $scope.activity_selected[0];
			if (item){
				$scope.showDialog('activity', item);
			}
			else{
				// There is nothing to edit!
			}
		};

		$scope.addActivity = function (ev){
			$scope.showDialog('activity', null);
		};

		// Donor
		$scope.removeDonor = function (ev){
			var item = $scope.donor_selected[0];
			$scope.removeDialog('donor', item, ev);
		};
		
		$scope.editDonor = function (ev){
			var item = $scope.donor_selected[0];
			if (item){
				$scope.showDialog('donor', item);
			}
			else{
			}
		};

		$scope.addDonor = function (ev){
			$scope.showDialog('donor', null);
		};

		// Library
		$scope.removeLibrary = function (ev){
			var item = $scope.library_selected[0];
			$scope.removeDialog('library', item, ev);
		};
		
		$scope.editLibrary = function (ev){
			var item = $scope.library_selected[0];
			if (item){
				$scope.showDialog('library', item);
			}
			else{
			}
		};

		$scope.addLibrary = function (ev){
			$scope.showDialog('library', null);
		};

		// Library
		$scope.removeUser = function (ev){
			var item = $scope.user_selected[0];
			$scope.removeDialog('user', item, ev);
		};
		
		$scope.editUser = function (ev){
			var item = $scope.user_selected[0];
			if (item){
				$scope.showDialog('user', item);
			}
			else{
			}
		};

		$scope.addUser = function (ev){
			$scope.showDialog('user', null);
		};

        $timeout(function() {
            // console.log($scope.map);
            // var map = $scope.map.control.getGMap();
            // var input = document.getElementById('pac-input');
            // if (!input){
            // 	return;
            // }
            // var searchBox = new google.maps.places.SearchBox(input);
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            // map.addListener('bounds_changed', function() {
            //     searchBox.setBounds(map.getBounds());

            // });
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            // searchBox.addListener('places_changed', function() {
            //     var places = searchBox.getPlaces();

            //     if (places.length == 0) {
            //         return;
            //     }
            //    	$scope.map.center.latitude = places[0].geometry.location.lat();
            //    	$scope.map.center.longitude = places[0].geometry.location.lng();
            //    	$scope.marker.coords.latitude = places[0].geometry.location.lat();
            //    	$scope.marker.coords.longitude = places[0].geometry.location.lng();
            //    	$scope.$apply();
            // });

            $scope.showMapSearchBox = true;

        }, 2000);

    }]);
}(app));