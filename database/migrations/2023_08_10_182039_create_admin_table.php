<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique()->nullable(false);
            $table->text('password')->nullable(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
}