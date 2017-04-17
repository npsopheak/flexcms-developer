(function (){
	app
		.service('CoResource', function ($timeout, $http, $window, $resource, $rootScope){
			var port = location.port || (location.protocol === 'http' ? 80 : 443);
			var $remoteUrl = namespace.domain + "admin/";
			// if ($rootScope.remoteUrl){
			// 	$remoteUrl = $rootScope.remoteUrl + 'api/admin/';
			// }
			function initializeRequest(){
				var session = $('meta[name="api:session"]');
				session = session ? session.attr('content') : '';
				var token = $('meta[name="api:bearer"]');
				token = token ? token.attr('content') : '';
				var request = $('meta[name="api:request"]');
				request = request ? request.attr('content') : '';

				$http.defaults.headers.common['X-GT-Connect-ID']= session;
				$http.defaults.headers.common['X-GT-Request-ID']= request;
				$http.defaults.headers.common['Authorization']= 'Bearer ' + token;

			}

			console.log(base + 'locations/:locationId');

			initializeRequest();

			function guid() {
			  	function s4() {
			    	return Math.floor((1 + Math.random()) * 0x10000)
			      	.toString(16)
			      	.substring(1);
			  	}
			  	return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
			    s4() + '-' + s4() + s4() + s4();
			}

			var base = $remoteUrl;

			var resources = {
				Item: $resource(base + 'dimensions/:itemId',
			 	{
			 		itemId:'@id',
  					cache : false
			 	}, {
			  		'update': { method:'PUT' },
			  		'list': {
			  			method: 'GET',
  						cache : false
			  		}
			 	}),
				ItemLocale: $resource(base + 'dimensions/:itemId/locale', null, {}),
				Media: $resource(base + 'media/:mediaId', { mediaId: '@id' }, {
					'list': {
			  			method: 'GET',
      					cache : false
			  		},
			  		'update': { method:'PUT' },
			  		'saveLink': {
			  			method: 'POST',
			  			url: base + 'media/link'
			  		},
			  		'setBestVideo': {
			  			method: 'POST',
			  			url: base + 'media/:mediaId/best-video',
					    mediaId: '@id'
			  		},
			  		'unsetBestVideo': {
			  			method: 'DELETE',
			  			url: base + 'media/:mediaId/best-video',
					    mediaId: '@id'
			  		}
				}),
				Location: $resource(base + 'locations/:locationId', {
					locationId: '@id',
      				cache : false
				}, {
			  		'update': { method:'PUT' },
					'setCover': {
						method: 'PUT',
						locationId: '@id',
						url: base + 'locations/:locationId/cover'
					},
					'deleteLogo': {
						method: 'DELETE',
						locationId: '@id',
						url: base + 'locations/:locationId/logo'
					},
			  		'list': {
			  			method: 'GET',
      					cache : false
			  		},

				}),
				Tour: $resource(base + 'tours/:tourId', {
					tourId: '@id',
      				cache : false
				}, {
			  		'update': { method:'PUT' },
					'setCover': {
						method: 'PUT',
						tourId: '@id',
						url: base + 'tours/:tourId/cover'
					},
					'deleteLogo': {
						method: 'DELETE',
						tourId: '@id',
						url: base + 'tours/:tourId/logo'
					},
			  		'list': {
			  			method: 'GET',
      					cache : false
			  		},


				}),
				TourBooking: $resource(base + 'tours/orders/:orderId', {
					orderId: '@id',
      				cache : false
				}, {
			  		'update': { method:'PUT' },
			  		'list': {
			  			method: 'GET',
      					cache : false
			  		},
			  		'getDrivers': {
			  			url: base + 'tours/find/drivers',
			  			method: 'POST',
      					cache : false
			  		},
			  		'assignDriver': {
			  			url: base + 'tours/orders/:orderId/assign-driver',
			  			method: 'POST',
						orderId: '@id',
      					cache : false
			  		},

				}),
				Driver: $resource(base + 'trips/finds/:findId', {
					findId: '@id',
      				cache : false
				}, {
			  		'update': { method:'PUT' },
			  		'list': {
			  			method: 'GET',
      					cache : false
			  		},

				}),
				PromotionNotification: $resource(base + 'promotions/notifications/:promotionId', {
					promotionId: '@id',
      				cache : false
				}, {
			  		// 'update': { method:'PUT' },
			  		'list': {
			  			method: 'GET',
      					cache : true
			  		},
					'deleteLogo': {
						method: 'DELETE',
						promotionId: '@id',
						url: base + 'promotions/notifications/:promotionId/image'
					},


				}),
			};

			//

			var caches = {};
			caches['Item'] = resources.Item.list(function (){
				caches['Item'] = caches['Item'].result;
			});

			return {
				resources: resources,
				caches: function (cacheName){
					return caches[cacheName];
				},
				textifyError: function (object){
					if (!object){
						return '';
					}
					if (object.error === 'general'){
						return object.result;
					}
					else if (object.error === 'validation-error'){
						return _.map(object.result, function (v){
							return v
						}).join (' ,');
					}
					else{
						return object.result;
					}
				}
			};
		});
}());
