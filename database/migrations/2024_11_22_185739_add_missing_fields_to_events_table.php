<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('time')->default('00:00:00')->after('end_date'); // Default time
            $table->string('map_link')->nullable()->after('venue'); // Nullable, no default
            $table->longText('banner_image')->nullable()->after('map_link'); // Nullable for base64 image
            $table->string('organizer_name')->default('Unknown Organizer')->after('banner_image'); // Default organizer
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['time', 'map_link', 'banner_image', 'organizer_name']);
        });
    }
}
