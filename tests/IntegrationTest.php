<?php

namespace Zhineng\LaravelSnowflake\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Orchestra\Testbench\TestCase;
use Zhineng\LaravelSnowflake\Facades\Snowflake;
use Zhineng\LaravelSnowflake\SnowflakeApplicationServiceProvider;
use Zhineng\LaravelSnowflake\SnowflakeServiceProvider;
use Zhineng\LaravelSnowflake\Tests\Fixtures\CreateNotesTable;
use Zhineng\LaravelSnowflake\Tests\Fixtures\Note;
use Zhineng\Snowflake\Snowflake as SnowflakeData;

class IntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        (new CreateNotesTable)->up();
    }

    public function testIdGenerated()
    {
        $note = Note::take('note');
        $this->assertIsInt($key = $note->getKey());
        $this->assertInstanceOf(SnowflakeData::class, $snowflake = Snowflake::parse($key));
        $this->assertTrue(Carbon::createFromTimestampMs($snowflake->timestamp)->is(Carbon::now()));
        $this->assertSame(0, $snowflake->instance);
        $this->assertSame(0, $snowflake->sequence);
    }

    public function testNotOverridesTheExistedId()
    {
        $note = tap(new Note, function ($note) {
            $note->id = 10000;
            $note->content = 'foo';
            $note->save();
        });

        $this->assertSame(10000, $note->getKey());
    }

    protected function getPackageProviders($app)
    {
        return [SnowflakeServiceProvider::class, SnowflakeApplicationServiceProvider::class];
    }
}
