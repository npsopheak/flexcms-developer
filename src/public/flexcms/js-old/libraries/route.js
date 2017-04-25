(function (){
	namespace.routes = [
	// Shop endpoint
	{
		url: '',
		template: '/partials/customs.locations.index',
		controller: 'LocationListingCtrl',
		reloadOnSearch: false
		// template: '/partials/posts',
		// controller: 'PostCtrl'
	},
	{
		url: 'locations/create',
		template: '/partials/customs.locations.create',
		controller: 'LocationCreateCtrl'
		// template: '/partials/posts',
		// controller: 'PostCtrl'
	},
	{
		url: 'locations/:id',
		template: '/partials/customs.locations.create',
		controller: 'LocationCreateCtrl'
		// template: '/partials/posts',
		// controller: 'PostCtrl'
	}, {
		url: 'locations',
		template: '/partials/customs.locations.index',
		controller: 'LocationListingCtrl',
		reloadOnSearch: false
	},
	{
		url: 'tours/create',
		template: '/partials/customs.tours.create',
		controller: 'TourCreateCtrl'
		// template: '/partials/posts',
		// controller: 'PostCtrl'
	},
	{
		url: 'tours/:id',
		template: '/partials/customs.tours.create',
		controller: 'TourCreateCtrl'
		// template: '/partials/posts',
		// controller: 'PostCtrl'
	}, {
		url: 'tours',
		template: '/partials/customs.tours.index',
		controller: 'TourListingCtrl',
		reloadOnSearch: false
	},
	{
		url: 'promotions/create',
		template: '/partials/customs.notifications.create',
		controller: 'PromotionCreateCtrl'
		// template: '/partials/posts',
		// controller: 'PostCtrl'
	},
	{
		url: 'promotions/:id',
		template: '/partials/customs.notifications.create',
		controller: 'PromotionCreateCtrl'
		// template: '/partials/posts',
		// controller: 'PostCtrl'
	}, {
		url: 'promotions',
		template: '/partials/customs.notifications.index',
		controller: 'PromotionListingCtrl',
		reloadOnSearch: false
	}, 
	// 
	{
		url: 'tour-bookings',
		template: '/partials/customs.tours.booking-list',
		controller: 'TourBookingListingCtrl',
		reloadOnSearch: false
	}];
}());