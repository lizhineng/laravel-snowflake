<?php

namespace Zhineng\LaravelSnowflake;

use Illuminate\Support\ServiceProvider;
use Zhineng\LaravelSnowflake\Facades\Snowflake;
use Zhineng\Snowflake\Fields\Field;
use Zhineng\Snowflake\Fields\Increment;
use Zhineng\Snowflake\Fields\Timestamp;
use Zhineng\Snowflake\IdStructure;

class SnowflakeApplicationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->defineSnowflake();
    }

    public function defineSnowflake()
    {
        Snowflake::usingStructure((new IdStructure)
            ->add($timestamp = Timestamp::make('timestamp', 41))
            ->add(Field::make('instance', 10))
            ->add(Increment::make('sequence', 12)->for($timestamp)));
    }

    public function register()
    {
        //
    }
}
