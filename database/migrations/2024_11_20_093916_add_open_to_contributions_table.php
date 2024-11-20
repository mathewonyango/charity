<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpenToContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contributions', function (Blueprint $table) {
            // Add the 'open' column to track if a contribution is open (true) or closed (false)
            $table->boolean('open')->default(true); // true = open, false = closed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contributions', function (Blueprint $table) {
            // Drop the 'open' column if this migration is rolled back
            $table->dropColumn('open');
        });
    }
}
