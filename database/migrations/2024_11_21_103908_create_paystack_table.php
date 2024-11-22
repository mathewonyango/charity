<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaystackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paystack', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('order_id');
            $table->integer('amount');
            $table->integer('quantity');
            $table->string('currency');
            $table->string('reference');
            $table->text('metadata')->nullable();
            $table->string('status')->nullable(); // Payment status (pending, completed, failed, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paystack');
    }
}
