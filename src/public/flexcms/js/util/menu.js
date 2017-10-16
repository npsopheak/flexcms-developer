console.log(namespace);
namespace.menus = [{
    name: 'content-management',
    text: 'Content Management',
    items: [
        // {
        //     name: 'Articles',
        //     extraScreen: 'article',
        //     icon: 'icon-office',
        //     enabled: true,
        //     path: '/articles'
        // },
        {
            name: 'Members',
            extraScreen: 'member',
            icon: 'icon-office',
            enabled: true,
            path: '/'
        },
        {
            name: 'Members1',
            extraScreen: 'member',
            icon: 'icon-office',
            enabled: true,
            path: '/staff'
        },
        {
            name: 'Members2',
            extraScreen: 'member',
            icon: 'icon-office',
            enabled: true,
            path: '/users'
        }
        // {
        //     name: 'Libraries',
        //     extraScreen: 'libraries',
        //     icon: 'icon-libreoffice',
        //     enabled: true,
        //     path: '/libraries'
        // }
    ]
}/*, {
    name: 'user',
    text: 'User',
    items: [
        { name: 'List', extraScreen: 'List accoount information', icon: 'icon-users', enabled: true, path: '/accounts' },
        // { name: 'Your account', extraScreen: 'Your account', icon: 'icon-user', enabled: false, path: '/account' },
    ]
}*/, {
    name: 'settings',
    text: 'Settings',
    items: [
        { name: 'Item', extraScreen: 'Item information', icon: 'icon-file-text', enabled: true, path: '/items' },   
        // { name: 'Message', extraScreen: 'Message information', icon: 'icon-mail3', enabled: true, path: '/messages' },
        { name: 'Your account', extraScreen: 'Your account', icon: 'icon-user', enabled: false, path: '/account' },
        { name: 'Sign out', extraScreen: 'Sign out', icon: 'icon-lock', enabled: false, path: '/signout', 'event': function ($scope){
            $scope.logout();
        }  }
    ]
}];

