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
        Schema::create('pre_programs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->string('activity');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
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
        Schema::dropIfExists('pre_programs');
    }
};
