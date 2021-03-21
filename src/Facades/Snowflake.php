<?php

namespace Zhineng\LaravelSnowflake\Facades;

use Illuminate\Support\Facades\Facade;
use Zhineng\Snowflake\IdStructure;
use Zhineng\Snowflake\SnowflakeMaker;

/**
 * @method static int nextId()
 * @method static \Zhineng\Snowflake\Snowflake next()
 * @method static \Zhineng\Snowflake\Snowflake parse(\Zhineng\Snowflake\Snowflake|string|int $snowflake)
 * @method static self usingStructure(IdStructure $structure)
 */
class Snowflake extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return SnowflakeMaker::class;
    }
}