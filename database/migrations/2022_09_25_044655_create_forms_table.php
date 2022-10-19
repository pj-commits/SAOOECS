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
            $table->id();
            $table->unsignedInteger('event_id');
            $table->foreignId('prep_by')->constrained('users');
            $table->foreignId('organization_id')->constrained('organizations');
            $table->string('event_title');

            $table->string('formable_type');
            $table->unsignedInteger('formable_id');
            
            $table->string('control_number');

            $table->string('curr_approver')->default('Adviser');
            $table->string('status')->default('Pending');

            //Adviser
            $table->foreignId('adviser_staff_id')->nullable();
            $table->boolean('adviser_is_approve')->default(0);
            $table->dateTime('adviser_date_approved')->nullable();
            //SAO
            $table->foreignId('sao_staff_id')->nullable();
            $table->boolean('sao_is_approve')->default(0);
            $table->dateTime('sao_date_approved')->nullable();
            //Academic Services
            $table->foreignId('acadserv_staff_id')->nullable();
            $table->boolean('acadserv_is_approve')->default(0);
            $table->dateTime('acadserv_date_approved')->nullable();
            //Finance
            $table->foreignId('finance_staff_id')->nullable();
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
