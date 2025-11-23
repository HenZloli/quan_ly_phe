<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccManagerTable extends Migration
{
    public function up()
    {
        Schema::create('acc_manager', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role')->default('user'); // user/admin
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acc_manager');
    }
}
