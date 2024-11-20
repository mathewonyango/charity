<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToContributionsTable extends Migration
{
    public function up()
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Add user_id column

            // Adding foreign key constraint (if user_id references the users table)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key constraint
            $table->dropColumn('user_id'); // Drop the user_id column
        });
    }
}
