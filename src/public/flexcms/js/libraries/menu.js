(function (){
	namespace.menus = [{
		name: 'content-management',
		text: 'Content Management',
		items: [
	        {
	        	name: 'Hotspot Locations',
	        	extraScreen: 'locations',
	        	icon: 'icon-office',
	        	enabled: true,
	        	path: '/locations'
	        },
	        {
	        	name: 'Tours',
	        	extraScreen: 'tours',
	        	icon: 'icon-map',
	        	enabled: true,
	        	path: '/tours'
	        },
	        {
	        	name: 'Promotions',
	        	extraScreen: 'promotions',
	        	icon: 'icon-gift',
	        	enabled: true,
	        	path: '/promotions'
	        }
	    ]
	}, {
		name: 'order',
		text: 'Order',
		items: [
	        {
	        	name: 'Tour Booking',
	        	extraScreen: 'tour-bookings',
	        	icon: 'icon-ticket',
	        	enabled: true,
	        	path: '/tour-bookings'
	        }
	    ]
	}, {
		name: 'settings',
		text: 'Settings',
		items: [
	        { name: 'Message', extraScreen: 'Message information', icon: 'icon-mail3', enabled: true, path: '/messages' },
	        //{ name: 'Your account', extraScreen: 'Your account', icon: 'icon-user', enabled: false, path: '/account' },
	        { name: 'Sign out', extraScreen: 'Sign out', icon: 'icon-lock', enabled: false, path: '/signout', 'event': function ($scope){
	        	$scope.logout();
	        }  }
	    ]
	}];
}());
