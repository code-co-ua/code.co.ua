<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstancesTable extends Migration
{
    public function up(): void
    {
        Schema::create('instances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('exercise_id');
            $table->unsignedSmallInteger('server_id');//todo - remove default
            $table->unsignedInteger('user_id');
            $table->string('container_id')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_completed')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instances');
    }
}
