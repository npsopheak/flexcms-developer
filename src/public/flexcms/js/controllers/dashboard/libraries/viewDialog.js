(function(app) {
    app.controller('DashboardLibrariesViewDialogCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', '$current', 'Upload', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter, $current, Upload) {

	    
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

            // Load resource document type
            CoResource.resources.Item.list({
                type: 'directory_library'
            }, function (s) {
                $scope.types = s.result;
            });

            // Edit the save

            $scope.save = function ($event, cb) {

                var success = function () {
                    $current = $scope.data;
                    $rootScope.$emit('dataDirectoryLibrarySaved', {
                        mode: $current ? 'edit' : 'create',
                        $current: $current
                    });
                    if (cb){
                        cb(null, $scope.data);
                    }
                    
                    return $mdDialog.show(
                        $mdDialog.alert({
                            preserveScope: true,
                            autoWrap: true,
                            skipHide: true,
                            title: 'Add Library info',
                            content: 'Library info has been saved',
                            ariaLabel: 'Add Library info',
                            ok: 'Got it!'
                        })
                    )
                        .finally(function () {
                            if (!cb){
                                // $mdDialog.hide();
                            }
                            
                        });
                };

                var fail = function (f) {
                    if (cb){
                        cb('Error saving', null);
                    }
                    
                    return $mdDialog.show(
                        $mdDialog.alert({
                            preserveScope: true,
                            autoWrap: true,
                            skipHide: true,
                            // parent: angular.element(document.body),
                            title: 'Add Library info',
                            content: 'There was an error while saving Library. ' + f,
                            ariaLabel: 'Add Library info',
                            ok: 'Got it!'
                        })
                    );
                };
                $rootScope.loading('show');

                if ($scope.data.id){

                    CoResource.resources.MemberLibrary.update({ 
                        id: $scope.data.directory_id, 
                        libraryId: $scope.data.id 
                    }, $scope.data, function (s, h) {
                        success();
                        $rootScope.loading('hide');
                    }, function (e) {
                        $rootScope.loading('hide');
                        fail(CoResource.textifyError(e.data));
                    });
                }
                else{
                    var item = new CoResource.resources.MemberLibrary($scope.data);
                    item.$save({
                        id: $scope.data.directory_id
                    }, function (s, h) {
                        $scope.data = s.result;
                        success();
                        $scope.savePendingUploads();
                        $rootScope.loading('hide');
                    }, function (e) {
                        $rootScope.loading('hide');
                        fail(CoResource.textifyError(e.data));
                    });
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
                $scope.chooseFile($scope.pendingUploads[k], function (data, file){
                    var uploadFileName = 'uploadingFile_' + v.fieldName;
                    $scope[uploadFileName].loading = false;
                    $scope[uploadFileName].src = false;

                    var result = data.result;
                    $scope.data[v.fieldName] = result.id;
                    $scope.data[v.fieldName.replace('_id', '')] = result;
                    $scope.save(null, function (er, data){
                        
                        // $mdDialog.hide();
                    });

                    $rootScope.loading('hide');
                    $timeout(function() {
                        $scope.data[v.fieldName.replace('_id', '')] = result;
                    }, 6000);
                });
    		});
    		$scope.pendingUploads = [];
    	};

		$scope.uploadDocument = function (files, fieldName, $event){
			if (!files.length){
    			return;
    		}
            var uploadFileName = 'uploadingFile_' + fieldName;
    		$scope[uploadFileName] = {
    			file: files[0],
    			type: 'document',
    			src: window.URL.createObjectURL(files[0]),
                fieldName: fieldName
    		};
            // console.log($scope[uploadFileName]);
    		if ($scope.mode === 'create'){
    			$scope.pendingUploads = _.filter($scope.pendingUploads, function (v){
    				return v.type != 'logo';
    			});
	    		$scope.pendingUploads.push($scope[uploadFileName]);
    		}
    		else{
    			$scope[uploadFileName].loading = true;
	    		$scope.chooseFile($scope[uploadFileName], function (data){
	            	$scope[uploadFileName].loading = false;
	            	$scope[uploadFileName].src = false;

	            	var result = data.result;
	            	$scope.data[fieldName] = result.id;
                    $scope.data[fieldName.replace('_id', '')] = result;
                    $scope.save($event, function (er, data){
                        
	            	    // $mdDialog.hide();
                    });

	            	$rootScope.loading('hide');
	            	$timeout(function() {
	            		$scope.data[fieldName.replace('_id', '')] = result;
                        console.log($scope.data);
	            	}, 6000);

	    		});
    		}
		}

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
                // No pending upload 
                file.loading = true;
                
                $scope.chooseFile(file, function (data, file){
                });
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
					imagable_type: 'DirectoryLibrary',
					imagable_id: $scope.data.id,
					caption: $scope.data.name,
					description: $scope.data.name,
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
			    	
			    	// data.result.thumbnail_url_link = filetmp.src;
			    }
			    else if (filetmp.type == 'logo'){

			    }

            }).error(function(data, status, headers, config) {
            	alert('There was an error while trying to upload file.');
            	console.log(data, status);
            	$scope.uploadingFile.loading = false;
            	$rootScope.loading('hide');
            });
    	};

        // Delete photo document

        $scope.deleteDocument = function (item, cb, ev){
            // Appending dialog to document.body to cover sidenav in docs app
            if (!item){
                return;
            }
            var confirm = $mdDialog.confirm({
                    multiple: true
                })
                .parent(angular.element(document.body))
                .title('Delete this Document?')
                .content('Are sure to do so? Once you deleted, you won\'t be able to retrieve it back!')
                .ariaLabel('Delete Document')
                .ok('Yes')
                .cancel('No')
                .targetEvent(ev);
            $mdDialog.show(confirm).then(function() {
                $rootScope.loading('show');
                CoResource.resources.Media.delete({
                	mediaId: item.id
                }, function (s){
                	$rootScope.loading('hide');
                	if (cb){
                        cb(null, item.id);
                    }
                	$mdToast.show(
                        $mdToast.simple()
                            .content('Document removed')
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

        $scope.deleteEnglishDocument = function (cb, ev){
            if ($scope.data.document_english){
                $scope.deleteDocument($scope.data.document_english, function (error, id){
                    $scope.data.document_english_id = null;
                    $scope.save(ev, function (er, data){
                        cb && cb();
                    });
                }, ev);
            }
        };

        $scope.deleteKhmerDocument = function (cb, ev){
            if ($scope.data.document_khmer){
                $scope.deleteDocument($scope.data.document_khmer, function (error, id){
                    $scope.data.document_khmer_id = null;
                    $scope.save(ev, function (er, data){
                        cb && cb();
                    });
                }, ev);
            }
        };

        $scope.previewDocument = function (item, ev){
            window.open(item.file_name);
        };


    }]);
}(app));