<?php namespace Frijj2k\AutoSwaggerUI\Providers;

use Illuminate\Support\ServiceProvider;
use Frijj2k\AutoSwaggerUI\Controllers\LaravelController;
use Frijj2k\AutoSwaggerUI\Controllers\LumenController;

/**
 * Class AutoSwaggerUIServiceProvider
 *
 * Service provider for registering the swagger ui configuration.
 *
 * @package Frijj2k\Referrals\Providers
 */
class AutoSwaggerUIServiceProvider extends ServiceProvider {

    const LUMEN_CONTROLLER = LumenController::class;
    const LARAVEL_CONTROLLER = LaravelController::class;

    const SWAGGER_UI_NAME = 'auto-swagger-ui';
    const SWAGGER_JSON_NAME = 'auto-swagger-ui.json';

    const DEFAULT_UI_URL = '/swagger-ui';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../../config/config.php' => config_path('swagger.php')]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $uiUrl = config('swagger.urls.ui', self::DEFAULT_UI_URL);

        $uiFn = '@getUiPath';

        $isLaravel = is_laravel();

        // registering a route varies for laravel and lumen
        if ($isLaravel) {
            // ---> Laravel Routes <----
            \Route::get($uiUrl . '{path}', ['as' => self::SWAGGER_UI_NAME, 'uses' => self::LARAVEL_CONTROLLER . $uiFn])->where(['path' => '.*']);
        }
        else {
            // ---> Lumen Routes <---
            $this->app->get($uiUrl . '{path:.*}', ['as' => self::SWAGGER_UI_NAME, 'uses' => self::LUMEN_CONTROLLER . $uiFn]);
        }
    }
}