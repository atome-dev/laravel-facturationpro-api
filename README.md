<p align="center"><a href="https://atome-dev.fr" target="_blank"><img src="https://www.atome-dev.fr/logo.jpg" width="400"></a></p>


## About Facturation Pro Api for Laravel
This package can help you call facturation.pro API services.

It is not owned by the facturation.pro company. It works with the API set to https://facturation.dev.

This package may not be complete and may not work properly, so use it for EDUCATIONAL PURPOSES ONLY!

Beside this recommendation, I personally use in real production so it should be stable but I cannot be responsible in any way for any malfunction.

## Install
composer require AtomeDev\FacturationProApi

## Export configuration file
php artisan vendor:publish --provider="AtomeDev\FacturationProApi\FacturationProApiServiceProvider" --tag="config"

## Export form views
php artisan vendor:publish --provider="AtomeDev\FacturationProApi\FacturationProApiServiceProvider" --tag="views"

## Testing form route (routes/web.php)
Route::view('/facturation-pro-api-form', 'facturation-pro-api-form')->name('facturation-pro-api-form');

## Security Vulnerabilities

If you discover a security vulnerability within this package, please send me an e-mail via [contact@atome-dev.fr](mailto:contact@atome-dev.fr). All security vulnerabilities will be promptly addressed.

## License

Facturation Pro Api for Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
 
