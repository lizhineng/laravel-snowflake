<?php

namespace Zhineng\LaravelSnowflake;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use Zhineng\Snowflake\SnowflakeMaker;

class SnowflakeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPublishing();
        $this->registerColumnType();
    }

    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/SnowflakeServiceProvider.stub' => app_path('Providers/SnowflakeServiceProvider.php'),
            ], 'laravel-snowflake-provider');
        }
    }

    private function registerColumnType()
    {
        Blueprint::macro('snowflake', function (string $column = 'id') {
            /** @var $this Blueprint */
            return $this->unsignedBigInteger($column)->primary();
        });
    }

    public function register()
    {
        $this->app->singleton(SnowflakeMaker::class, function ($app) {
            return new SnowflakeMaker;
        });
    }
}
