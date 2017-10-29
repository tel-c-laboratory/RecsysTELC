<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('nim')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('photo')->default('user.png');
            $table->string('password');
            $table->string('jurusan')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('angkatan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('user_level')->default('Peserta');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
