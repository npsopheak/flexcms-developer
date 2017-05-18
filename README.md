# FlexCMS

Developed to use in-house for faster dashboard iteration.

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