# How to use


Clone repo

	git clone https://github.com/webdevmatics/eShop.git
Install the composer dependencies

	composer install
	
Save .env.example as .env and put your database credentials

Set application key

	php artisan key:generate        

And Migrate with

`php artisan migrate`

Install node dependencies

`npm install`

Compile assets

`npm run dev`

Open in browser

`php artisan serve`
