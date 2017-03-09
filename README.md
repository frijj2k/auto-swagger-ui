# auto-swagger-ui
Give your project some swagger docs in a matter of seconds. Simply just install the package and service providers,
optionally adding the configuration file, then BAM you now have a swagger ui endpoint. 

Also integrates with swagger php annotations, allowing you scan your annotations and generate a json object at 
a specified endpoint. 1, 2, 3, too much swag. ;)

## Install
```bash
composer require frijj2k/auto-swagger-php
```

## Setup

### Add to the Service Providers:
#### Laravel:
In `config/app.php` add `\Frijj2k\AutoSwaggerUI\Providers\AutoSwaggerUIServiceProvider::class,` to `providers`.

#### Lumen:
In `bootstrap/app.php` add `$app->register(\Frijj2k\AutoSwaggerUI\Providers\AutoSwaggerUIServiceProvider::class);`


## Config

public the configuration file:

```bash
php artisan vendor:publish
```
Then the config pieces can be edited how you please.
```php
<?php

return array(
    // All values except are set by default

    // the path to the swagger ui implementation. By default will use its own swagger ui
    // 'path' => app_path('/swagger/dist'),

    'urls' => [
        // the url of the swagger ui
        'ui' => '/swagger-ui',
        // the url location for the scanned output (point it to your scan endpoint
        'json' => '/swagger.json'
    ]

);
```

*Note: Lumen will probably need to copy the config from the config file in this package, to `swagger.php` and 
register the configuration `$app->configure('swagger');` in the `bootstrap/app.js`.*