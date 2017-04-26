namespace.endpoints = function ($resource, base) {
	return {
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
		// ItemLocale: $resource(base + 'dimensions/:itemId/locale', null, {}),
		// Media: $resource(base + 'media/:mediaId', { mediaId: '@id' }, {
		// 	'list': {
	  	// 		method: 'GET',
		// 			cache : false
	  	// 	},
	  	// 	'update': { method:'PUT' },
	  	// 	'saveLink': {
	  	// 		method: 'POST',
	  	// 		url: base + 'media/link'
	  	// 	},
	  	// 	'setBestVideo': {
	  	// 		method: 'POST',
	  	// 		url: base + 'media/:mediaId/best-video',
		// 	    mediaId: '@id'
	  	// 	},
	  	// 	'unsetBestVideo': {
	  	// 		method: 'DELETE',
	  	// 		url: base + 'media/:mediaId/best-video',
		// 	    mediaId: '@id'
	  	// 	}
		// }),
		Article: $resource(base + 'articles/:articleId', {
			articleId: '@id',
				cache : false
		}, {
	  		'update': { method:'PUT' },
			'setCover': {
				method: 'PUT',
				locationId: '@id',
				url: base + 'articles/:articleId/cover'
			},
			'deleteLogo': {
				method: 'DELETE',
				locationId: '@id',
				url: base + 'articleId/:locationId/logo'
			},
	  		'list': {
	  			method: 'GET',
					cache : false
	  		},

		}),
	};

};