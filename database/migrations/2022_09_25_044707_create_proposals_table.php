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
            $table->foreignId('organization_users_id');
            $table->date('target_date');
            $table->integer('activity_title');
            $table->integer('duration_val');
            $table->string('duration_unit');
            $table->string('venue');
            $table->string('act_classification');
            $table->string('act_location');
            $table->string('description');
            $table->string('rationale');
            $table->string('outcome');
            $table->string('primary_audience');
            $table->integer('num_primary_audience');
            $table->string('secondary_audience');
            $table->integer('num_secondary_audience');
            $table->integer('internal_coorganizer');
            $table->tinyInteger('have_requisition');
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
