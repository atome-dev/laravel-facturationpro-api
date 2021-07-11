<p align="center"><a href="https://atome-dev.fr" target="_blank"><img src="https://www.atome-dev.fr/logo.jpg" width="400"></a></p>


## About Facturation Pro Api for Laravel
This package can help you call facturation.pro API services.

It is not owned by the facturation.pro company. It works with the API set to https://facturation.dev.

This package may not be complete and may not work properly, so use it for EDUCATIONAL PURPOSES ONLY!

Beside this recommendation, I personally use it in real production so it should be stable but I cannot be responsible in any way for any malfunction.

## Install
composer require atome-dev/laravel-facturation-pro-api

## Export configuration file
php artisan vendor:publish --provider="AtomeDev\FacturationProApi\FacturationProApiServiceProvider" --tag="config"

## Usage

/app/Http/Controllers/FacturationProController.php:
```php
namespace App\Http\Controllers;

use AtomeDev\FacturationProApi\Facades\FacturationProApi;
use Illuminate\Http\Request;

class FacturationProController extends Controller
{
    public function index() {
        $infoApi = FacturationProApi::getApi('account', 'infos');
        $ret = FacturationProApi::callApi($infoApi);
        dump($ret);
    }
}
```
/routes/web.php: 
```php
Route::get('/facturation-pro', [FacturationProController::class, 'index']);
``` 
 
![image](https://user-images.githubusercontent.com/81640238/125179083-263c9200-e1eb-11eb-9290-d9ae3d1bd30f.png)




## Security Vulnerabilities

If you discover a security vulnerability within this package, please send me an e-mail via [contact@atome-dev.fr](mailto:contact@atome-dev.fr). All security vulnerabilities will be promptly addressed.

## License

Facturation Pro Api for Laravel is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
