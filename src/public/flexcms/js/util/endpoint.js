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

};