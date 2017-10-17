(function(app) {
    app.controller('DashboardUsersListCtrl', ['$scope', '$timeout', '$mdSidenav',
        '$mdUtil', '$log', '$rootScope', '$mdDialog', '$routeParams', '$location',
        '$mdToast', 'CoResource', 'filterFilter', function($scope, $timeout, $mdSidenav,
        $mdUtil, $log, $rootScope, $mdDialog, $routeParams, $location,
        $mdToast, CoResource, filterFilter) {

             
    $scope.person = [
        { id: 1, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
         { id: 2, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Inactive',registrationdate:'1999/2/22' },
          { id: 3, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Pending',registrationdate:'1999/2/22' },
           { id: 4, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Banned',registrationdate:'1999/2/22' },
            { id: 5, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
             { id: 6, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Inactive',registrationdate:'1999/2/22' },
              { id: 7, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
               { id: 8, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Inactive',registrationdate:'1999/2/22' },
                { id: 9, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
                 { id: 10, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Inactive',registrationdate:'1999/2/22' },
        { id: 11, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
         { id: 12, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
          { id: 13, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
           { id: 14, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
            { id: 15, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
             { id: 16, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
              { id: 17, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
               { id: 18, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
                { id: 19, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
                 { id: 20, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
        { id: 21, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
         { id: 22, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
          { id: 23, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
           { id: 24, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
            { id: 25, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
             { id: 26, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
              { id: 27, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
               { id: 28, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
                { id: 29, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },
                 { id: 30, name: 'John', username: 'Rambo',email: 'sokpheng@gmail.com',status: 'Active',registrationdate:'1999/2/22' },

    ];

    	    $scope.myModel = 1;

            $scope.myOptions = [
            {id: 1, title: 'Admin'},
            {id: 2, title: 'Staff'},
            {id: 3, title: 'CEO'}
            ];

            $scope.myConfig = {
            create: true,
            valueField: 'id',
            labelField: 'title',
            delimiter: '|',
            placeholder: 'Pick something',
            onInitialize: function(selectize){
            },
			};


    }]);
}(app));