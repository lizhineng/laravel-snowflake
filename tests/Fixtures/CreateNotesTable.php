<?php

namespace Zhineng\LaravelSnowflake\Tests\Fixtures;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->snowflake();
            $table->text('content');
            $table->timestamps();
        });
    }
}
