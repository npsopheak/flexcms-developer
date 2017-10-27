# FlexCMS

Developed to use in-house for faster dashboard iteration.

# FlexAuth

1. Login with user session

`FlexAuth::login('userAdmin', $userData)`

2. Update user session

```
FlexAuth::update('userAdmin', function ($session){
    $session['field'] = 'value';
});

```
3. Update user info session

```
FlexAuth::updateInfo('userAdmin', function ($session){
    $session['field'] = 'value';
});

```

4. Is Login (return false/true)

Use closure if you want to specify the field to check.

```

$result = FlexAuth::isLogin('userAdmin', function ($session){
    return is_array($session) && is_set($session['_id']);
});

```

5. Logout

```

FlexAuth::logout('userAdmin');

```

6. Get property of the object or auth value

```

FlexAuth::getProperty('role.name', 'userAdmin', null);

```

## Install via composer 

Add the 0.1.0 version to composer.json

```json
    "require": {
        "php": ">=5.6.4",
        "FlexCMS/BasicCMS": "dev-0.1.0"
    },

```
# Sample Project

### Sample dashboard login 

Create dashboard controller extending the AuthController

```php

class DashboardController extends \FlexCMS\BasicCMS\Api\Auth\AuthController

```

Implement the abstract classes

```php

    public function login(){
        try{
            if (\Input::get('username') == null){
                throw new Exception('Username is required');
            }
            if (\Input::get('password') == null){
                throw new Exception('Password is required');
            }

            $result = FlexRequest::post('admin/authenticate', [
                'email' => \Input::get('username'),
                'password' => \Input::get('password')
            ]);

            // Check your login logic
            $result = $result['responseText'];

            if ($result['status'] == 'success' && $result['result'] && isset($result['result']['token'])){
                // Do login
                FlexAuth::login('user', $result['result']);
                return redirect('/dashboard');
            }
            else{

                print_r($result);
                die();
            }


        }
        catch (\Exception $e){
            print_r($e);
            die();
            return redirect('/dashboard/login')->with([
                'message' => 'Cannot login ' . $e->getMessage()
            ]);
        }
    }
    public function logout(){
        
    }
    public function apiLogin(){
        
    }
    public function apiLogout(){
        
    }

```

Add your own routes

```

Route::post('/dashboard/login', 'Dashboard\DashboardController@login');

```

Edit route in the dashboard login

## Command

Create page:

```

php artisan flex:add dashboard MODULE PAGE

```

Remove page

```

php artisan flex:add dashboard MODULE PAGE

```

Run composer update or install to install the latest version

## Publish the vendor

To publish provider flexcms: `php artisan vendor:publish --provide="FlexCMS/BasicCMS"`

## Configuration

Add these to your .env for customize the configuration value

```
    CMS_REQUEST_ID=X-XX-Request-ID
    CMS_SESSION_ID=X-XX-ConNEPt-ID
    CMS_ENCRYPT_KEY_ID=X-XX-Sign-Key
	CMS_USER_AGENT=Documentation Dashboard
    CMS_ENDPOINT=http://localhost:8000/api/v1/
	CMS_WS_ENDPOINT=http://localhost:8000/api/v1/
	CMS_TOKEN_PROPERTY=access_token
    CMS_REQUEST_ID_VALUE =MGUwMTIwZDEyNmYzZTA4ZDI5ZGFkYzcxZWFmMjhhOGU1MDU3OWNjNzRmZDA1ZWUzZjkyZmU5NTc0OWI1ZjE4Nw==
```

# Using in production

## Step to install package to the new project

### Sample repo

1. Accept this repo: https://github.com/npsopheak/techs-job

2. You need to add two things to your current composer.json (sample at: https://github.com/npsopheak/techs-job/blob/master/composer.json)

### Add package installation to the `composer.json`

Thing to added:

`"FlexCMS/BasicCMS": "dev-0.1.0"` to `"require": { ... }`

and 

```json

    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/npsopheak/flexcms-developer/"
        }
    ]
```

to the end of the json line.

### Composer install/dashboard install

You can run `composer install` to install the dashboard project into the current project

(similar in this readme at: https://github.com/npsopheak/flexcms-developer)

### Publish the package content for customization

Publish the package content into the project: `php artisan vendor:publish --provide="FlexCMS/BasicCMS"`

#### Accessing script and views

You can access the js at: `public/js/vendor/flexcms` and view at `resources/views/vendor/flexcms`

### Define login controller 

You can define the login controller at: https://github.com/npsopheak/flexcms-developer#sample-dashboard-login

# Development command

- Run `gulp watch-dev` in path `/src/` to watch assets like JS or Image or CSS change.
- Run `gulp bcss watch` in path `/src/` to watch for SCSS style update
- Run `npm run publish` in path `/src/` to build resources and publish for production ready
- Run `npm run publish-dev-public` in path `/src/` to publish public to project actual public path
- Run `npm run publish-dev-resource` in path `/src/` to publish resource to project actual resource path

# Setup on first run

Create a file name `setup.sh` in project root directory as following:

- Run `nano setup.sh`
- Add below content

```sh

#!/bin/bash

workingBranch='develop_tenglay';
currentBranch='develop_NEW_NAME';

rm -R packages/FlexCMS/BasicCMS/*
cd packages/FlexCMS/BasicCMS/
git clone https://github.com/npsopheak/flexcms-developer.git .

git checkout $workingBranch
git checkout -b $currentBranch
git checkout $currentBranch
composer install
cd src
npm install
bower install
cd ../../../..

# For current local project
cp .env.example .env
composer install
npm install
bower install

```

- Add executable permission by `chmod +x setup.sh`
- Run the setup by `./setup.sh`
- Later when you commit change push your code to `git push origin $currentBranch`
- Migration db at your project root directory run: `php artisan migrate`
- Seed db at your project root directory run: `php artisan db:seed --class=FlexCMS\\BasicCMS\\Seeds\\DatabaseSeeder`
- (Do not forget to create the db in your server or localhost and change config in `.env`)
- Change `APP_ENV` to `APP_ENV=local` for development and `APP_ENV` to `APP_ENV:stage` for staging server deployment
