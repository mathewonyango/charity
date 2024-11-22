<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('paystack', function (Blueprint $table) {
            $table->unsignedBigInteger('contribution_id')->nullable()->after('metadata');
            $table->unsignedBigInteger('event_id')->nullable()->after('contribution_id');

            // Foreign key constraints without cascading actions
            $table->foreign('contribution_id')
                ->references('id')
                ->on('contributions');

            $table->foreign('event_id')
                ->references('id')
                ->on('events');
        });
    }

    public function down()
    {
        Schema::table('paystack', function (Blueprint $table) {
            $table->dropForeign(['contribution_id']);
            $table->dropForeign(['event_id']);
            $table->dropColumn(['contribution_id', 'event_id']);
        });
    }

};
