<?php

// database/migrations/xxxx_xx_xx_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('employee_id')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('password');
            $table->string('address');
            $table->date('birth_day');
            $table->string('phone_number');
            $table->string('position');
            $table->string('department');
            $table->integer('Status');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Optional, adds a deleted_at column for soft deletes
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
