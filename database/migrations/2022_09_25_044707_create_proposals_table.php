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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained();
            $table->foreignId('organizer');
            $table->date('targetDate');
            $table->integer('durationVal');
            $table->string('durationUnit');
            $table->string('venue');
            $table->string('actClassificationA');
            $table->string('actClassificationB');
            $table->string('description');
            $table->string('outcome');
            $table->string('rationale');
            $table->string('primaryAudience');
            $table->integer('numPrimaryAudience');
            $table->string('secondaryAudience')->nullable();
            $table->integer('numSecondaryAudience')->nullable();
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
        Schema::dropIfExists('proposals');
    }
};
