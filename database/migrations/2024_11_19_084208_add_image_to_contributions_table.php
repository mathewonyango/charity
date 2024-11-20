<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToContributionsTable extends Migration
{
    public function up()
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->text('image')->nullable()->after('organizer_contact'); // Add base64 image column
        });
    }

    public function down()
    {
        Schema::table('contributions', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
