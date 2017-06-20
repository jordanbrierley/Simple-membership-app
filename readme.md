## Simple application with subscription service using paypal to become a member to view secure images

Details of how to install and compile assets below, based on laravel 4.2

If you clone this into your directory and run `composer update` to install all the necessary packages for the application

### Quick install instructions
1. Clone repository into your directory
2. Run `composer update`
3. Set up env file to connect to database and PayPal SDK Token [from here](https://developer.paypal.com/developer/applications/braintreeCredentials/editbtcredLive) (note. if your running this from the command line it uses the local environment see `/bootstrap/start.php line:29`)
4. Run `php artisan migrate --seed` to create the database with some sample data
5. Navigate to `/resources` and run `npm install` to install package dependancies
6. Run `gulp build` to compile assets into the public directory


###  Building Assets
To build the assets if you first navigate to the `/resources` folder in the document root and run `npm install` to install all the package dependancies
Then you can then run `gulp build` which will run the build process to compile these in the `/public` folder on the document root.

You can 'watch' these assets to update and compile with live reloading by running `gulp` from the `/resources` directory as long as you make sure to run `php artisan serve --host HOSTNAME` where `HOSTNAME` matches the value set in `/resources/gulp/conf Line:14 - exports.proxy = 'HOSTNAME:PORT';`.

eg. `php artisan serve --host animals.dev`, `exports.proxy = 'http://animals.dev:8000';`


I've included a sample `.env.sample.php` as an example although this shouldn't really be in version control I've included it in here for now so you have an example.


### Paypal

You may need to get either a sandbox key or production key from [https://developer.paypal.com/developer/applications/braintreeCredentials/editbtcredLive](https://developer.paypal.com/developer/applications/braintreeCredentials/editbtcredLive), if you add this key in the env.local.php file for the `'PAYPAL_BRAINTREE_SDK_TOKEN'`.

It's currently set in production, to change it to sandbox you can change `line 95` in `/resources/src/assets/js/main.js` and set `env: 'sandbox'`.

### Logins

For an example user login you can use:
username = user
password = user

For an example member login you can use:
username = member
password = member
