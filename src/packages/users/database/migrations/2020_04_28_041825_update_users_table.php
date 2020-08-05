<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('password_reset')) {
            shell_exec('php artisan migrate --path=vendor/laravel/ui/stubs/migrations/');
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('type');
            $table->string('type_contribute')->nullable();
            $table->date('founding')->nullable();
            $table->integer('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('business')->nullable();
            $table->string('business_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
