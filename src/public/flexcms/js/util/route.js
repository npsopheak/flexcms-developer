
namespace.routes = [

// DEVELOP TENGLAY ROUTE
// @inused
{
    url: '',
    template: '/partials/dashboard.careers.list',
    controller: 'DashboardCareersListCtrl',
    reloadOnSearch: false
},
{
    url: 'careers',
    template: '/partials/dashboard.careers.list',
    controller: 'DashboardCareersListCtrl',
    reloadOnSearch: false
},
{
    url: 'careers/candidates',
    template: '/partials/dashboard.careers.candidateList',
    controller: 'DashboardCareersCandidateListCtrl',
    reloadOnSearch: false
},
{
    url: 'careers/create',
    template: '/partials/dashboard.careers.create',
    controller: 'DashboardCareersCreateCtrl',
    reloadOnSearch: false
},
{
    url: 'careers/:id',
    template: '/partials/dashboard.careers.create',
    controller: 'DashboardCareersCreateCtrl',
    reloadOnSearch: false
},

// DEVELOP ROUTE 
// @deprecated
// Shop endpoint
// {
//     url: '',
//     template: '/partials/dashboard.articles.list',
//     controller: 'DashboardArticlesListCtrl',
//     reloadOnSearch: false
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// {
//     url: '',
//     template: '/partials/dashboard.members.list',
//     controller: 'DashboardMembersListCtrl',
//     reloadOnSearch: false
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// Member endpoit
// {
//     url: 'members',
//     template: '/partials/dashboard.members.list',
//     controller: 'DashboardMembersListCtrl',
//     reloadOnSearch: false
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// {
//     url: 'members/create',
//     template: '/partials/dashboard.members.create',
//     controller: 'DashboardMembersCreateCtrl',
//     reloadOnSearch: false
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// {
//     url: 'members/:id',
//     template: '/partials/dashboard.members.create',
//     controller: 'DashboardMembersCreateCtrl',
//     reloadOnSearch: false
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// // Libraries endpoit
// {
//     url: 'libraries',
//     template: '/partials/dashboard.libraries.list',
//     controller: 'DashboardLibrariesListCtrl',
//     reloadOnSearch: false
// },
// {
//     url: 'libraries/create',
//     template: '/partials/dashboard.libraries.create',
//     controller: 'DashboardLibrariesCreateCtrl',
//     reloadOnSearch: false
// },
// {
//     url: 'libraries/:id',
//     template: '/partials/dashboard.libraries.create',
//     controller: 'DashboardLibrariesCreateCtrl',
//     reloadOnSearch: false
// },
// // Users endpoit
// {
//     url: 'accounts',
//     template: '/partials/dashboard.users.list',
//     controller: 'DashboardUsersListCtrl',
//     reloadOnSearch: false
// },
// {
//     url: 'accounts/create',
//     template: '/partials/dashboard.users.create',
//     controller: 'DashboardUsersCreateCtrl',
//     reloadOnSearch: false
// },
// {
//     url: 'accounts/:id',
//     template: '/partials/dashboard.users.create',
//     controller: 'DashboardUsersCreateCtrl',
//     reloadOnSearch: false
// },
// // Item
// {
//     url: 'items',
//     template: '/partials/dashboard.items.list',
//     controller: 'DashboardItemsListCtrl',
//     reloadOnSearch: false
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// // Shop endpoint
// {
//     url: 'articles',
//     template: '/partials/dashboard.articles.list',
//     controller: 'DashboardArticlesListCtrl',
//     reloadOnSearch: false
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// {
//     url: 'articles/create',
//     template: '/partials/dashboard.articles.create',
//     controller: 'DashboardArticlesCreateCtrl'
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// },
// {
//     url: 'articles/:id',
//     template: '/partials/dashboard.articles.create',
//     controller: 'DashboardArticlesCreateCtrl'
//     // template: '/partials/posts',
//     // controller: 'PostCtrl'
// }
];
