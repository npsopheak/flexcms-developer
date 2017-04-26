(function (app){
	app
		.service('CoResource', ['$timeout', '$http', '$window', '$resource', '$rootScope', function ($timeout, $http, $window, $resource, $rootScope){
			var port = location.port || (location.protocol === 'http' ? 80 : 443);
			var $remoteUrl = namespace.domain;
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

			var resources = namespace.endpoints($resource, base);

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
		}]);
}(app));
