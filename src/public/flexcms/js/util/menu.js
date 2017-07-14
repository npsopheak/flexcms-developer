console.log(namespace);
namespace.menus = [{
    name: 'content-management',
    text: 'Content Management',
    items: [
        {
            name: 'Articles',
            extraScreen: 'article',
            icon: 'icon-office',
            enabled: true,
            path: '/articles'
        },
        {
            name: 'Post',
            extraScreen: 'article',
            icon: 'icon-quill',
            enabled: true,
            path: '/posts'
        },
        // {
        //     name: 'Members',
        //     extraScreen: 'member',
        //     icon: 'icon-office',
        //     enabled: true,
        //     path: '/members'
        // },
        // {
        //     name: 'Libraries',
        //     extraScreen: 'libraries',
        //     icon: 'icon-libreoffice',
        //     enabled: true,
        //     path: '/libraries'
        // },
        // {
        //     name: 'Careers',
        //     extraScreen: 'careers',
        //     icon: 'icon-libreoffice',
        //     enabled: true,
        //     path: '/careers'
        // }, {
        //     name: 'Career Candidates',
        //     extraScreen: 'career candidates',
        //     icon: 'icon-user-tie',
        //     enabled: true,
        //     path: '/careers/candidates'
        // },
        // { name: 'Quotes Request', extraScreen: 'quote request', icon: 'icon-mail3', enabled: true, path: '/quotes' },
    ]
}, {
    name: 'user',
    text: 'User',
    items: [
        { name: 'List', extraScreen: 'List accoount information', icon: 'icon-users', enabled: true, path: '/accounts' },
        // { name: 'Your account', extraScreen: 'Your account', icon: 'icon-user', enabled: false, path: '/account' },
    ]
}, {
    name: 'settings',
    text: 'Settings',
    items: [
        // { name: 'Item', extraScreen: 'Item information', icon: 'icon-file-text', enabled: true, path: '/items' },   
        // { name: 'Message', extraScreen: 'Message information', icon: 'icon-mail3', enabled: true, path: '/messages' },
        { name: 'Your account', extraScreen: 'Your account', icon: 'icon-user', enabled: false, path: '/accounts/me', role: 'any' },
        { name: 'Sign out', extraScreen: 'Sign out', icon: 'icon-lock', enabled: false, path: '/signout', 'event': function ($scope){
            $scope.logout();
        }  }
    ]
}];

