<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proof_of_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('liquidation_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('item_from'); 
            $table->unsignedInteger('item_to'); 
            $table->string('image');
            $table->timestamps();
        });
        Schema::create('liquidation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('liquidation_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('item_number');
            $table->date('date_bought');
            $table->string('item');
            $table->decimal('price', 5, 2);
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
        Schema::dropIfExists('proof_of_payments');
        Schema::dropIfExists('proof_of_payments');
    }
};
