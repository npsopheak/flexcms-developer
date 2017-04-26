
namespace.routes = [
// Shop endpoint
{
    url: '',
    template: '/partials/dashboard.articles.list',
    controller: 'DashboardArticlesListCtrl',
    reloadOnSearch: false
    // template: '/partials/posts',
    // controller: 'PostCtrl'
},
// Shop endpoint
{
    url: 'articles',
    template: '/partials/dashboard.articles.list',
    controller: 'DashboardArticlesListCtrl',
    reloadOnSearch: false
    // template: '/partials/posts',
    // controller: 'PostCtrl'
},
{
    url: 'articles/create',
    template: '/partials/dashboard.articles.create',
    controller: 'DashboardArticlesCreateCtrl'
    // template: '/partials/posts',
    // controller: 'PostCtrl'
},
{
    url: 'articles/:id',
    template: '/partials/dashboard.articles.create',
    controller: 'DashboardArticlesCreateCtrl'
    // template: '/partials/posts',
    // controller: 'PostCtrl'
}];
