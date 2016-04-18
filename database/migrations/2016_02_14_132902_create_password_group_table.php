<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_password', function (Blueprint $table) {
            $table->unsignedInteger('password_id');
            $table->unsignedInteger('group_id');
            $table->timestamps();

            $table->foreign('password_id')->references('id')->on('passwords')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['password_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group_password');
    }
}
