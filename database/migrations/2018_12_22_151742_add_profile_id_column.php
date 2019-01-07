<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('profiles', function (Blueprint $table) {
//            $table->string('profile_image_path')->nullable();
//            $table->integer('user_id')->unsigned()->unique();
//            $table->foreign('user_id')->references('id')->on('users');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('profiles', function (Blueprint $table) {
//            $table->dropForeign(['user_id']);
//            $table->dropColumn(['user_id', 'profile_image_path']);
//        });
    }
}
