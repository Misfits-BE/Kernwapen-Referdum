<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class helpderServiceProvider
 * ----
 * Service provider voor de aanmaken van helpers. (Blade views)
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Providers
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        require_once app_path() . '/Helpers/Dates.php';
    }
}
