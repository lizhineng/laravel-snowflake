<?php

namespace Zhineng\LaravelSnowflake\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Zhineng\LaravelSnowflake\Concerns\HasSnowflake;

class Note extends Model
{
    use HasSnowflake;

    protected $guarded = [];

    public static function take(string $note): self
    {
        return static::create(['content' => $note]);
    }
}
