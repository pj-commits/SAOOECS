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
        Schema::create('forms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('event_id');

            $table->foreignUuid('prep_by')->references('id')->on('users');
            $table->foreignUuid('organization_id')->references('id')->on('organizations');

            $table->string('event_title');
            $table->date('target_date');
            $table->string('form_type');
            $table->string('control_number');

            $table->string('curr_approver')->default('Adviser');
            $table->string('status')->default('Pending');
            $table->date('deadline')->nullable();
            $table->string('remarks')->nullable();

            //Adviser
            $table->foreignUuid('adviser_staff_id')->references('id')->on('organization_user')->nullable();
            // $table->foreignId('adviser_staff_id')->nullable();
            $table->boolean('adviser_is_approve')->default(0);
            $table->dateTime('adviser_date_approved')->nullable();
            //SAO
            $table->foreignUuid('sao_staff_id')->references('id')->on('staff')->nullable();
            // $table->foreignId('sao_staff_id')->nullable();
            $table->boolean('sao_is_approve')->default(0);
            $table->dateTime('sao_date_approved')->nullable();
            //Academic Services
            $table->foreignUuid('acadserv_staff_id')->references('id')->on('staff')->nullable();
            // $table->foreignId('acadserv_staff_id')->nullable();
            $table->boolean('acadserv_is_approve')->default(0);
            $table->dateTime('acadserv_date_approved')->nullable();
            //Finance
            $table->foreignUuid('finance_staff_id')->references('id')->on('staff')->nullable();
            // $table->foreignId('finance_staff_id')->nullable();
            $table->boolean('finance_is_approve')->default(0);
            $table->dateTime('finance_date_approved')->nullable();
            
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
        Schema::dropIfExists('forms');
    }
};
