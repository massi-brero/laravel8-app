<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserIdInHobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hobbies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                  ->nullable()
                  ->after('id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('hobbies', function (Blueprint $table) {
//            $table->dropForeign('user_id');
//        });

//        Schema::table('hobbies', function (Blueprint $table) {
//            $table->dropColumn('user_id');
//        });
    }
}
