namespace.endpoints = function ($resource, base) {
	return {
		Item: $resource(base + 'items/:itemId',
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
		// @only this project [might be]
		Career: $resource(base + 'jobs/:id', {
			id: '@id',
			cache : false
		}, {
	  		'update': { method:'PUT' },
	  		'list': {
	  			method: 'GET',
				cache : false
	  		},
	  		'listCandidate': {
				url: base + 'jobs/applications',
	  			method: 'GET',
				cache : false
	  		},
	  		'updateCandidate': {
				url: base + 'jobs/applications/:id',
	  			method: 'POST',
				cache : false
	  		}, 
		}),
		// @deprecated for this project
		// Member: $resource(base + 'directories/:id', {
		// 	id: '@id',
		// 		cache : false
		// }, {
	  	// 	'update': { method:'PUT' },
		// 	'setCover': {
		// 		method: 'PUT',
		// 		id: '@id',
		// 		url: base + 'directories/:id/cover'
		// 	},
		// 	'deleteLogo': {
		// 		method: 'DELETE',
		// 		id: '@id',
		// 		url: base + 'directories/:id/logo'
		// 	},
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		// MemberStaff: $resource(base + 'directories/:id/staffs/:staffId', {
		// 	id: '@id',
		// 	cache : false,
		// 	staffId: '@id'
		// }, {
	  	// 	'update': { method:'PUT' },
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		// MemberDonor: $resource(base + 'directories/:id/donors/:donorId', {
		// 	id: '@id',
		// 	cache : false,
		// 	donorId: '@id'
		// }, {
	  	// 	'update': { method:'PUT' },
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		// MemberBudget: $resource(base + 'directories/:id/budgets/:budgetId', {
		// 	id: '@id',
		// 	cache : false,
		// 	budgetId: '@id'
		// }, {
	  	// 	'update': { method:'PUT' },
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		// MemberActivity: $resource(base + 'directories/:id/activities/:activityId', {
		// 	id: '@id',
		// 	cache : false,
		// 	activityId: '@id'
		// }, {
	  	// 	'update': { method:'PUT' },
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		// MemberContact: $resource(base + 'directories/:id/contacts/:contactId', {
		// 	id: '@id',
		// 	cache : false,
		// 	contactId: '@id'
		// }, {
	  	// 	'update': { method:'PUT' },
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		// MemberLibrary: $resource(base + 'directories/:id/libraries/:libraryId', {
		// 	id: '@id',
		// 	cache : false,
		// 	libraryId: '@id'
		// }, {
	  	// 	'update': { method:'PUT' },
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		// MemberUser: $resource(base + 'directories/:id/users/:userId', {
		// 	id: '@id',
		// 	cache : false,
		// 	userId: '@id'
		// }, {
	  	// 	'update': { method:'PUT' },
	  	// 	'list': {
	  	// 		method: 'GET',
		// 		cache : false
	  	// 	},

		// }),
		User: $resource(base + 'users/:id', {
			id: '@id',
			cache : false
		}, {
	  		'update': { method:'PUT' },
	  		'list': {
	  			method: 'GET',
				cache : false
	  		},

		}),
	};

};