<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // In a migration file
public function up()
{
    Schema::table('events', function (Blueprint $table) {
        $table->string('organizer_contact_info')->nullable(); // Store contact info as a JSON string
        $table->json('event_coordinators')->nullable(); // Store event coordinators as JSON
        $table->decimal('ticket_price', 10, 2)->nullable(); // Store ticket price
        $table->date('registration_deadline')->nullable(); // Store registration deadline
        $table->integer('event_capacity')->nullable(); // Store event capacity
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn([
            'organizer_contact_info',
            'event_coordinators',
            'ticket_price',
            'registration_deadline',
            'event_capacity'
        ]);
    });
}

};
