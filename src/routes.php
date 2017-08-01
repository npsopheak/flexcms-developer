<?php


// Dashboard route

// Public route group
// Add web as default middleware
Route::group(['prefix' => '', 'middleware' => ['web', 'csrf'], 'namespace' => 'FlexCMS\BasicCMS\Api'], function()
{

    Route::get('/dashboard', ['middleware' => ['auth'], 'as' => 'dashboard', 'uses' => function () {
        return view('flexcms::dashboard.index');
    }]);

    Route::get('/dashboard/login', ['middleware' => ['guest'], 'as' => 'login', 'uses' => function () {
        return view('flexcms::dashboard.login');
    }]);

    Route::get('/dashboard/browse-media', function () {
        return view('flexcms::dashboard.browse-media');
    });
    Route::post('/dashboard/login', ['uses' => 'Auth\AuthController@login']);
    Route::get('/dashboard/signout', ['uses' => 'Auth\AuthController@getLogout']);
    Route::post('/dashboard/api/login', ['uses' => 'Auth\AuthController@apiLogin']);
    Route::get('/dashboard/api/signout', ['uses' => 'Auth\AuthController@getApiLogout']);

    Route::get('/partials/{name}', function ($name) {
        return view('flexcms::pages.' . $name);
    });

    // Route::get('/templates/{name}', function ($name) {
    //     return view('flexcms::dashboard.templates.' . $name);
    // });

});


// @inuse in this dashboard version
// Public auth route group
Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api\Auth', 'middleware' => ['cors']], function()
{
    Route::post('/login', ['uses' => 'AuthController@apiLogin']);

});
// Test route
Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api'], function()
{
    Route::get('/sites', 'SiteController@index');

    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{id}', 'ArticleController@show');

    Route::get('/directories/categories', 'DirectoryController@indexByCategory');
    // Directory endpoint for libray list all
    Route::get('/directories/libraries', 'DirectoryController@indexLibrary');
    
    Route::get('directories', 'DirectoryController@index');
    Route::get('directories/{id}', 'DirectoryController@show');

    Route::get('items', 'ItemController@index');
    Route::get('items/{id}', 'ItemController@show');
    Route::get('/media/{id}', 'MediaController@show');
    Route::get('/media', 'MediaController@index');

});



Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api', 'middleware' => ['web', 'cors']], function()
{
    Route::get('/sites/pages', 'SiteController@availablePages');

    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{id}', 'ArticleController@show');

    Route::get('/directories/categories', 'DirectoryController@indexByCategory');
    // Directory endpoint for libray list all
    Route::get('/directories/libraries', 'DirectoryController@indexLibrary');
    
    Route::get('directories', 'DirectoryController@index');
    Route::get('directories/{id}', 'DirectoryController@show');

    Route::get('items', 'ItemController@index');
    Route::get('items/{id}', 'ItemController@show');
    Route::get('/media/{id}', 'MediaController@show');
    Route::get('/media', 'MediaController@index');

});


// Private route group
Route::group(['prefix' => 'api/v1', 'namespace' => 'FlexCMS\BasicCMS\Api', 'middleware' => ['web', 'auth', 'cors']], function()
{
    Route::post('/sites/pages', 'SiteController@createPage');
    Route::put('/sites/pages/{pageName}', 'SiteController@updatePage');

    Route::resource('articles', 'ArticleController', ['except' => ['show', 'index']]);
    Route::post('articles/{id}/locale/{language}', 'ArticleController@locale');
    Route::post('articles/{id}/publish', 'ArticleController@publish');
    Route::post('articles/{id}/schedule', 'ArticleController@schedule');
    Route::post('articles/{id}/drop-to-draft', 'ArticleController@pullAsDraft');

    // Directory endpoint for downloads
    Route::get('directories/downloads', 'DirectoryController@indexDownload');

    Route::resource('directories', 'DirectoryController', ['except' => ['show', 'index']]);

    Route::resource('collections', 'CollectionController', ['except' => ['create', 'edit']]);

    Route::resource('messages', 'MessageController', ['except' => ['create', 'edit', 'update']]);
    Route::post('/messages/{id}/seen', 'MessageController@updateSeen');
    Route::post('/messages/{id}/read', 'MessageController@updateRead');

    Route::resource('items', 'ItemController', ['except' => ['show', 'index']]);
    Route::post('/items/{id}/locale', 'ItemController@locale');

    Route::post('/media', 'MediaController@store');
    Route::post('/media/editor', 'MediaController@storeFromEditor');
    Route::post('/media/link', 'MediaController@storeLink');
    // Route::get('/media/{id}', 'MediaController@show');
    Route::put('/media/{id}', 'MediaController@update');
    Route::delete('/media/{id}', 'MediaController@destroy');
    Route::post('/media/{id}/best-video', 'MediaController@setBestVideo');
    Route::delete('/media/{id}/best-video', 'MediaController@unSetBestVideo');
    // Route::get('/media', 'MediaController@index');

    // Product detail

    Route::get('products/{id}/', 'Custom\ProductController@show');

    // User endpoint for managing user information
    Route::resource('users', 'UserController');
    Route::post('users/{id}/password', 'UserController@changePassword');
    Route::post('users/{id}/directory', 'UserController@assignDirectoryMember');
    Route::delete('users/{id}/directory', 'UserController@unassignDirectoryMember');

    // Directory endpoint for staff 
    Route::get('directories/{directoryId}/staffs', 'DirectoryController@indexStaff');
    Route::post('directories/{directoryId}/staffs', 'DirectoryController@storeStaff');
    Route::put('directories/{directoryId}/staffs/{id}', 'DirectoryController@updateStaff');
    Route::delete('directories/{directoryId}/staffs/{id}', 'DirectoryController@destroyStaff');
    Route::get('directories/{directoryId}/staffs/{id}', 'DirectoryController@showStaff');

    // Directory endpoint for donor 
    Route::get('directories/{directoryId}/donors', 'DirectoryController@indexDonor');
    Route::post('directories/{directoryId}/donors', 'DirectoryController@storeDonor');
    Route::put('directories/{directoryId}/donors/{id}', 'DirectoryController@updateDonor');
    Route::delete('directories/{directoryId}/donors/{id}', 'DirectoryController@destroyDonor');
    Route::get('directories/{directoryId}/donors/{id}', 'DirectoryController@showDonor');

    // Directory endpoint for libray
    Route::get('directories/{directoryId}/libraries', 'DirectoryController@indexLibrary');
    Route::post('directories/{directoryId}/libraries', 'DirectoryController@storeLibrary');
    Route::put('directories/{directoryId}/libraries/{id}', 'DirectoryController@updateLibrary');
    Route::delete('directories/{directoryId}/libraries/{id}', 'DirectoryController@destroyLibrary');
    Route::get('directories/{directoryId}/libraries/{id}', 'DirectoryController@showLibrary');

    // Directory endpoint for budgets
    Route::get('directories/{directoryId}/budgets', 'DirectoryController@indexBudget');
    Route::post('directories/{directoryId}/budgets', 'DirectoryController@storeBudget');
    Route::put('directories/{directoryId}/budgets/{id}', 'DirectoryController@updateBudget');
    Route::delete('directories/{directoryId}/budgets/{id}', 'DirectoryController@destroyBudget');
    Route::get('directories/{directoryId}/budgets/{id}', 'DirectoryController@showBudget');

    // Directory endpoint for activities
    Route::get('directories/{directoryId}/activities', 'DirectoryController@indexActivity');
    Route::post('directories/{directoryId}/activities', 'DirectoryController@storeActivity');
    Route::put('directories/{directoryId}/activities/{id}', 'DirectoryController@updateActivity');
    Route::delete('directories/{directoryId}/activities/{id}', 'DirectoryController@destroyActivity');
    Route::get('directories/{directoryId}/activities/{id}', 'DirectoryController@showActivity');

    // Directory endpoint for contacts
    Route::get('directories/{directoryId}/contacts', 'DirectoryController@indexContact');
    Route::post('directories/{directoryId}/contacts', 'DirectoryController@storeContact');
    Route::put('directories/{directoryId}/contacts/{id}', 'DirectoryController@updateContact');
    Route::delete('directories/{directoryId}/contacts/{id}', 'DirectoryController@destroyContact');
    Route::get('directories/{directoryId}/contacts/{id}', 'DirectoryController@showContact');

    // Directory endpoint for users
    Route::get('directories/{directoryId}/users', 'DirectoryController@indexUser');
    Route::post('directories/{directoryId}/users', 'DirectoryController@storeUser');
    Route::put('directories/{directoryId}/users/{id}', 'DirectoryController@updateUser');
    Route::delete('directories/{directoryId}/users/{id}', 'DirectoryController@destroyUser');
    Route::get('directories/{directoryId}/users/{id}', 'DirectoryController@showUser');


});


// // Public route group with app Id
// Route::group(['prefix' => 'api/v1', 'namespace' => 'Api', 'middleware' => ['app.auth', 'cors']], function()
// {
//     Route::get('/subscriptions/email-check', 'SubscriptionController@checkEmail');
//     Route::post('/subscriptions', 'SubscriptionController@store');

// });
