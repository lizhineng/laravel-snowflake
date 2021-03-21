<?php

namespace Zhineng\LaravelSnowflake\Concerns;

use Zhineng\LaravelSnowflake\Facades\Snowflake;

trait HasSnowflake
{
    public function initializeHasSnowflake()
    {
        $this->setIncrementing(false);
        $this->setKeyType('int');
    }

    public static function bootHasSnowflake()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Snowflake::nextId();
            }
        });
    }
}
